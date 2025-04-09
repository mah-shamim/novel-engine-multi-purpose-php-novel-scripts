document.addEventListener('DOMContentLoaded', function() {
    var authForm = document.querySelectorAll('.auth');
    var accountPage = document.getElementById('profile');
    var filePage = document.getElementById('file');

    var payAction = document.getElementById("subscribe");

    var overlay = $(".overlay2");

    const DECIMAL_FEE = 0.0150;
    const FEE_CAP = 2000;
    const FLAT_FEE = 100;

// Function to calculate total price for amounts below 2500
const calculateFor2500Below = (amount) => {
    const applicableFees = DECIMAL_FEE * amount;

    if (applicableFees > FEE_CAP) {
        return amount + FEE_CAP;
    } else {
        // Return the total price after applying fees and adding a small value (0.01)
        return ((amount) / (1 - DECIMAL_FEE)) + 0.01;
    }
}

// Function to calculate total price for amounts equal to or above 2500
const calculateFor2500Above = (amount) => {
    const applicableFees = (DECIMAL_FEE * amount) + FLAT_FEE;

    if (applicableFees > FEE_CAP) {
        return amount + FEE_CAP;
    } else {
        // Return the total price after applying fees, including a flat fee, and adding a small value (0.01)
        return ((amount + FLAT_FEE) / (1 - DECIMAL_FEE)) + 0.01;
    }
}

// Main function to calculate total price based on different conditions
 const calculateTotalPrice = (amount) => {
    const amt = amount;

    // If amount is less than 100, round it to the nearest integer and add 1
    if (amt < 100) {
        return Math.round(amt + 1);
    } else if (amt < 2500) {
        // Calculate total price for amounts below 2500
        return Math.round(calculateFor2500Below(amt));
    } else {
        // Calculate total price for amounts equal to or above 2500
        return Math.round(calculateFor2500Above(amt));
    }
} 

    if(payAction) {
        payAction.addEventListener('submit', function(e) {
            e.preventDefault();
            overlay.removeClass('d-none');
            var form = this;
            var formData = new FormData(form);
            const PUBLIC_KEY = document.getElementById('paystack').value;

            fetch('/ajax', {
                method: 'POST',
                body: formData
            }).then(response => {
                if(!response.ok) {
                    overlay.addClass('d-none');
                    throw new Error("Network Error");
                }

                return response.json();
            }).then(data => {
                overlay.addClass('d-none');
                if(data.s === 1) {
                    var reference = data.reference;
                    var user = data.user;
                    var package = data.package;
                    
                    var handler = PaystackPop.setup({
                        key: PUBLIC_KEY,
                        userid: user.id,
                        email: user.email, 
                        amount: calculateTotalPrice(package.price) * 100,
                        firstname: user.name,
                        ref: reference,
        
                        callback: function(response) {

                            const res = response.reference;
                            fetch('/ajax', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams({
                                    action: 'verify',
                                    reference: res,  
                                })
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error("Network Error");
                                }
                                return response.json();
                            }).then(data => {
                                if (data.s === 1) {
                                    Swal.fire('Success', data.m, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Warning', data.m, 'warning');
                                }
                            }).catch((error) => {
                                console.error('Error:', error);
                            });
                            
                        },

                        onClose: function() {
                            Swal.fire('Warning', 'Payment was not completed, window closed.', 'warning');
                          },
                    });

                    handler.openIframe();

                } else {
                    overlay.addClass('d-none');
                    Swal.fire('Warning', data.m, 'warning');
                }

            }).catch((error) => {
                console.error('Error:', error);
            });
        });
    }

    if (authForm) {
        authForm.forEach( element => {
            element.addEventListener('submit', function(e) {
                e.preventDefault();
                overlay.removeClass('d-none');
                var form = this;
                var formData = new FormData(form);
    
                fetch('/ajax', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        overlay.addClass('d-none');
                        throw new Error("Network response was not ok");
                    }
    
                    return response.json();
                }).then(data => {
                    overlay.addClass('d-none');
                    if (data.s == 1) {
                        Swal.fire('Success', data.m, 'success').then(() => {
                            if(accountPage !== null || filePage !== null) {
                                location.reload();
                            } else {
                            window.location.href = '/';
                            }
                        });
                    } else {
                        Swal.fire('Warning', data.m, 'warning');
                    }
                }).catch((xhr, error) => {
                    overlay.addClass('d-none');
                    console.error('Error:',error + xhr);
                });
            });
        });

    }
});

function toggleDarkMode() {
    const body = document.body;
    const button = document.getElementById('darkModeToggle');
    body.classList.toggle('dark-mode');
    
    if (body.classList.contains('dark-mode')) {
        button.innerHTML  = '<i class="fal fa-sun"></i>';
    } else {
        button.innerHTML  = '<i class="fal fa-moon"></i>';
    }
}

function navigateHome() {
    window.location.href = '/'; // Change this to your home URL
}

function increaseFontSize() {
    const bookElement = document.querySelector('.book');
    const currentFontSize = window.getComputedStyle(bookElement).fontSize;
    const newFontSize = parseFloat(currentFontSize) + 2;
    bookElement.style.fontSize = `${newFontSize}px`;
}

function decreaseFontSize() {
    const bookElement = document.querySelector('.book');
    const currentFontSize = window.getComputedStyle(bookElement).fontSize;
    const newFontSize = parseFloat(currentFontSize) - 2;
    bookElement.style.fontSize = `${newFontSize}px`;
}

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
      .then(function(registration) {
        console.log('Service Worker registered with scope:', registration.scope);
      })
      .catch(function(error) {
        console.log('Service Worker registration failed:', error);
      });
}
  

let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
  e.preventDefault();
  deferredPrompt = e;
  showInstallPromotion();  // Implement this function to show a custom install promotion UI
});

function showInstallPromotion() {
  const installButton = document.getElementById('install-button');
  installButton.style.display = 'block';

  installButton.addEventListener('click', () => {
    installButton.style.display = 'none';
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the install prompt');
      } else {
        console.log('User dismissed the install prompt');
      }
      deferredPrompt = null;
    });
  });
}




