import { ckeditor } from './../vendor/ckeditor/main.js';

$(document).ready(function () {
  var table = $('#dataTable').attr('data-table');

  if($(".desc3").length > 0) {
    ckeditor('', '.desc3');
  }

  if($(".desc4").length > 0) {
    ckeditor('', '.desc4');
  }

  if($("#desc").length > 0) {
    ckeditor('', '#desc');
  }
	
  // Create the editor instance

    $(document).on("submit", "#addpost", function (event) {
        event.preventDefault();

        const form = this;
        const overlay = $(".overlay");
        const submitButton = $(form).find(".submit");

        overlay.removeClass("d-none");
        submitButton.prop("disabled", true);

        const $cf = $(form);
        const isEdit = $(form).find('#isEdit').length > 0;
        const formData = new FormData(form);

       

        $.ajax({
            url: "./ajax", // Update the URL with the appropriate endpoint
            type: "POST",
            data: formData,
            dataType: 'json',      
            processData: false,
            contentType: false,
            success: function (data) {
                submitButton.prop("disabled", false);
                overlay.addClass("d-none");
                // Check the structure of the 'data' variable returned by the server
                if (data && data.s === 1) {
                    dataTable.draw(false);
                    Swal.fire({
                        title: 'Success!',
                        text: data.m,
                        icon: 'success',
                        didClose: function () {
                            if (!isEdit) {
                                $cf.trigger('reset');
                                // Clear specific form elements as needed
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data ? data.m : 'Unknown error occurred',
                        icon: 'warning'
                    });
                }
            },
            error: function (xhr, status, error) {
                
          Swal.fire("Error", "There was an error processing your request. Please try again later.", "error");
          console.log(xhr.responseText);
                
                submitButton.prop("disabled", false);
                overlay.addClass("d-none");
            }
        });
    });

     $(document).on("click", "#sitemap", function (event) {
        event.preventDefault();

        const overlay = $(".overlay");

        overlay.removeClass("d-none");


       

        $.ajax({
            url: "./ajax", // Update the URL with the appropriate endpoint
            type: "POST",
            data: {
                action: 'sitemap',
            },
            success: function (data) {
                overlay.addClass("d-none");
                // Check the structure of the 'data' variable returned by the server
                if (data && data.s === 1) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.m,
                        icon: 'success',
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data ? data.m : 'Unknown error occurred',
                        icon: 'warning'
                    });
                }
            },
            error: function (xhr, status, error) {
                
          Swal.fire("Error", "There was an error processing your request. Please try again later.", "error");
          console.log(xhr.responseText);
                
                overlay.addClass("d-none");
            }
        });
    });


  function initSelect2(id, type, pid ='') {
    
    var selectID = $("#"+id);
    let ids = '';
    var isID = pid.length > 0;
    if(isID) {
      ids = pid;
    }
    


    if(selectID) {

        $.ajax({
            type: 'POST',
            url: `/SHU-Admin/${table}/process`,
            data: {
              submit : type,
              type: type,
              id: ids,
            },
            success: function(html){
                $('#'+id).html(html);
            },
            error: function (xhr, status, error) {
              console.error('AJAX Error:', status, error);
          }
        }); 
    }
}





    

  $('#addmodal').on('shown.bs.modal', function () {



    $('#author').select2({
      dropdownParent: $('#addmodal'),
      tags: true,
      tokenSeparators: [',', ' '],
      minimumInputLength: 3,
      language: {
          inputTooShort: function () {
              return '';
          }
      },
      ajax: {
          url: `/SHU-Admin/${table}/process`,
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  query: params.term,
                  submit: 'search'
              };
          },
         processResults: function (data) {
          
      return { results: data };
  },
          cache: true
      }
      
  });
});

$(".substype").select2();

$('#editmodal').on('shown.bs.modal', function () {
  
  $("#category2").select2({
    dropdownParent: $('#editmodal'),
  });

  $("#bookalbum1").select2({
    dropdownParent: $('#editmodal'),
  });

  var pid = $('.postID').val();
  initSelect2('category2', 'category', pid);

  initSelect2('bookalbum1', 'book', pid);
 



  $('#authorEdit').select2({
    dropdownParent: $('#editmodal'),
    tags: true,
    tokenSeparators: [','],
    minimumInputLength: 3,
    language: {
        inputTooShort: function () {
            return '';
        }
    },
    ajax: {
        url: `/SHU-Admin/${table}/process`,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                query: params.term,
                submit: 'search'
            };
        },
       processResults: function (data) {
        
    return { results: data };
},
        cache: true
    }
    
});

$('#groupsEdit').select2({
  dropdownParent: $('#editmodal'),
  tags: true,
  tokenSeparators: [','],
  minimumInputLength: 3,
  language: {
      inputTooShort: function () {
          return '';
      }
  },
  ajax: {
      url: `/SHU-Admin/${table}/process`,
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              query: params.term,
              submit: 'groups'
          };
      },
     processResults: function (data) {
      
  return { results: data };
},
      cache: true
  }
  
});

$('#compiler1').select2({
  dropdownParent: $('#editmodal'),
  tags: true,
  tokenSeparators: [','],
  minimumInputLength: 3,
  language: {
      inputTooShort: function () {
          return '';
      }
  },
  ajax: {
      url: `/SHU-Admin/${table}/process`,
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              query: params.term,
              submit: 'compiler'
          };
      },
     processResults: function (data) {
      
  return { results: data };
},
      cache: true
  }
  
});




});

$('#addsmodal').on('shown.bs.modal', function () {

  $("#category").select2({
    dropdownParent: $('#addsmodal'),
  });

  initSelect2('category', 'category');

  $('#author').select2({
    dropdownParent: $('#addsmodal'),
    tags: true,
    tokenSeparators: [','],
    minimumInputLength: 3,
    language: {
        inputTooShort: function () {
            return '';
        }
    },
    ajax: {
        url: `/SHU-Admin/${table}/process`,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                query: params.term,
                submit: 'search'
            };
        },
       processResults: function (data) {
        
    return { results: data };
},
        cache: true
    }
    
});

$('#groups').select2({
  dropdownParent: $('#addsmodal'),
  tags: true,
  tokenSeparators: [','],
  minimumInputLength: 3,
  language: {
      inputTooShort: function () {
          return '';
      }
  },
  ajax: {
      url: `/SHU-Admin/${table}/process`,
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              query: params.term,
              submit: 'groups'
          };
      },
     processResults: function (data) {
      
  return { results: data };
},
      cache: true
  }
  
});

});

$('#ebookmodal').on('shown.bs.modal', function () {

  initSelect2('bookalbum', 'book');
 

  $("#bookalbum").select2({
    dropdownParent: $('#ebookmodal'),
  });

  initSelect2('bookalbum1', 'book');
 

  $("#bookalbum1").select2({
    dropdownParent: $('#ebookmodal'),
  });

  initSelect2('category', 'category');
 

  $("#category").select2({
    dropdownParent: $('#ebookmodal'),
  });

  initSelect2('category1', 'category');
 

  $("#category1").select2({
    dropdownParent: $('#ebookmodal'),
  });

 

  var form = $(this).closest('form');

  var ebookModal = ("#ebookmodal");
  
  var author1 = $('#author1');
  var group1 = $('#group1');
  var compiler1 = $('#compiler1');


  var author = $('#author');
  var group = $('#group');
  var compiler = $('#compiler');


  author.select2({
    dropdownParent: $('#ebookmodal'),
    tags: true,
    tokenSeparators: [','],
    minimumInputLength: 3,
    language: {
        inputTooShort: function () {
            return '';
        }
    },
    ajax: {
        url: `/SHU-Admin/${table}/process`,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                query: params.term,
                submit: 'search'
            };
        },
       processResults: function (data) {
        
    return { results: data };
},
        cache: true
    }

    
    
});

group.select2({
  dropdownParent: $('#ebookmodal'),
  tags: true,
  tokenSeparators: [','],
  minimumInputLength: 3,
  language: {
      inputTooShort: function () {
          return '';
      }
  },
  ajax: {
      url: `/SHU-Admin/${table}/process`,
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              query: params.term,
              submit: 'groups'
          };
      },
     processResults: function (data) {
      
  return { results: data };
},
      cache: true
  }
  
});

compiler.select2({
  dropdownParent: $('#ebookmodal'),
  tags: true,
  tokenSeparators: [','],
  minimumInputLength: 3,
  language: {
      inputTooShort: function () {
          return '';
      }
  },
  ajax: {
      url: `/SHU-Admin/${table}/process`,
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              query: params.term,
              submit: 'compiler'
          };
      },
     processResults: function (data) {
      
  return { results: data };
},
      cache: true
  }
  
});

author1.select2({
  dropdownParent: $('#ebookmodal'),
  tags: true,
  tokenSeparators: [','],
  minimumInputLength: 3,
  language: {
      inputTooShort: function () {
          return '';
      }
  },
  ajax: {
      url: `/SHU-Admin/${table}/process`,
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              query: params.term,
              submit: 'search'
          };
      },
     processResults: function (data) {
      
  return { results: data };
},
      cache: true
  }

  
  
});

group1.select2({
dropdownParent: $('#ebookmodal'),
tags: true,
tokenSeparators: [','],
minimumInputLength: 3,
language: {
    inputTooShort: function () {
        return '';
    }
},
ajax: {
    url: `/SHU-Admin/${table}/process`,
    dataType: 'json',
    delay: 250,
    data: function (params) {
        return {
            query: params.term,
            submit: 'groups'
        };
    },
   processResults: function (data) {
    
return { results: data };
},
    cache: true
}

});

compiler1.select2({
dropdownParent: $('#ebookmodal'),
tags: true,
tokenSeparators: [','],
minimumInputLength: 3,
language: {
    inputTooShort: function () {
        return '';
    }
},
ajax: {
    url: `/SHU-Admin/${table}/process`,
    dataType: 'json',
    delay: 250,
    data: function (params) {
        return {
            query: params.term,
            submit: 'compiler'
        };
    },
   processResults: function (data) {
    
return { results: data };
},
    cache: true
}

});







});

  


var dataTable = $('#dataTable').DataTable({
  "processing": true,
  "serverSide": true,
  "stateSave": true,
  "ajax": {
      "url": `/SHU-Admin/${table}/process`,
      "type": "POST",
      "data": function (d) {
          d.order = [{ column: d.order[0].column, dir: d.order[0].dir }];
          d.submit = "list";
          d.table = table;
          d.filterdata = $("#dataTable").attr('data-filter');
      },
      "error": function (xhr, error, thrown) {
          // Display a user-friendly error message
          Swal.fire("Error", "There was an error processing your request. Please try again later.", "error");
          console.log(xhr.responseText);
      }
  },
  "columns": null,
  "order": [[0, 'desc']],
  "initComplete": function (settings, json) {
      if (json.columns) {
          this.api().columns().header().to$().each(function (column, idx) {
              $(column).text(json.columns[idx]);
          });
      }
  },
  responsive: true,
  dom: "Bflrtip",
  select: {
      style: "os",
      selector: "td:nth-child(2)",
  },
  buttons: [
      "selectAll",
      "selectNone",
      {
          text: "Delete",
          className: "btn btn-danger waves-effect waves-light",
          action: function () {
              var selectedRows = dataTable.rows({ selected: true }).data().toArray();
              var ids = selectedRows.map(row => row[0]);
              var count = dataTable.rows({ selected: true }).count();
              if (count > 0) {
                  ActiontoStatus("deleteAll");
              } else {
                  Swal.fire("Error", "You did not select any item" + table, "warning");
              }
          },
      },
  ],
  "createdRow": function (row, data, dataIndex) {
      var selectedRows = dataTable.rows({ selected: true }).data().toArray();
      var ids = selectedRows.map(row => row[0]);
      var count = dataTable.rows({ selected: true }).count();
      if (count > 0) {
          $('td', row).css({ 'color': 'white', 'background-color': '' });
      } else {
          $('td', row).css({ 'color': 'black', 'background-color': '' });
      }
  }
});


    
    $(document).on("input", ".post-title", function (e) {
      e.preventDefault();
      var post_title = $(this).val();
      var form = $(this).closest('form');
      let chk = '';
      let id = '';
      let bookt = '';
      let isb = '';
      var isEdit = $(form).find('#isEdit').length > 0;
      var isBook = $(form).find('#isBook').length > 0;
      var isEbook = $(form).find('#isEbook').length > 0;

      if(isEdit) {
        chk = "shuraihu";
        id =  $(form).find('.postID').val();
      } else if(isBook) {
        isb = "shuraihu";
        bookt = "book";
        id =  $(form).find('.postID').val();
      } else if(isEbook) {
        isb = "shuraihu";
        bookt = "ebook";
        id =  $(form).find('.postID').val();
      }

      $.ajax({
        type: "POST",
        url: `/SHU-Admin/${table}/process`,
        dataType: 'json',
        data: {
          slug: post_title,
          submit: 'checkSlug',
          edit: chk,
          id: id,
          book: bookt,

          
        },
        success: function(data) {
          form.find(".slug").val(data);
        }
      });
      
  });

    $(document).on("input", ".slug", function (e) {
        e.preventDefault();
        var post_title = $(this).val();
        var form = $(this).closest('form');
        let chk = '';
        let bookt = '';
        let id = '';
        var isEdit = $(form).find('#isEdit').length > 0;
        var isBook = $(form).find('#isBook').length > 0;
        var isEbook = $(form).find('#isEbook').length > 0;


        if(isEdit) {
          chk = "shuraihu";
          id =  $(form).find('.postID').val();
        } else if(isBook) {
          bookt = "book";
          id =  $(form).find('.postID').val();
        } else if(isEbook) {
          isb = "shuraihu";
          bookt = "ebook";
          id =  $(form).find('.postID').val();
        }

        
        
        $.ajax({
          type: "POST",
          url: `/SHU-Admin/${table}/process`,
          dataType: 'json',
          data: {
            slug: post_title,
            submit: 'checkSlug',
            edit: chk,
            id: id,
            book: bookt,
            
          },
          success: function(data) {
            form.find(".slug").val(data);
          }
        });
        
    });


    $("#file_input").change(function() {

      var form = $(this).closest('form');

      var filename = $(this)[0].files[0];
      if(filename) {
        var newfile = filename.name.replace(/\.php|\.js/i, "");
        form.find(".post-title").val(newfile);
      }

    });

    $("#file_input2").change(function() {

      var form = $(this).closest('form');

      var filename = $(this)[0].files[0];
      if(filename) {
        var newfile = filename.name.replace(/\.php|\.js/i, "");
        form.find(".post-title").val(newfile);
      }

    });
  

$(document).on("click", ".showTrash", function (e) {
    e.preventDefault();
    $(".showingBy").text(`Trashed ${table[0].toUpperCase()+table.slice(1)} `);
    $("#dataTable").attr('data-filter', 'Trashed');
    dataTable.ajax.reload();
});

const showModal = (c, id) => {
  $(document).on("click", c, function(e) {
    e.preventDefault();
    $("#"+id).modal('show');
  });
}

showModal(".modalse", "addsmodal");
showModal(".ebm", "ebookmodal");
showModal(".ebk", "ebookmodal");


$(document).on("click", ".modalse", function(e) {
  e.preventDefault();
  var form = $(this).closest('form');
  let cid = $(this).data('id');
  let slug = $(this).data('slug');
  $("#cid").val(cid);
  
});

$(document).on("click", '.ebm', function(e) {
  e.preventDefault();
  var form = $(this).closest('form');
  let cid = $(this).data('id');
  $("#cid2").val(cid);
  var ddd = $("#cid2").val();
});

$(document).on("click", '.ebk', function(e) {
  e.preventDefault();
  var form = $(this).closest('form');
  let baid = $(this).data('id');
  $("#baid").val(baid);
  let cid = $(this).data('cid');
  $("#cid2").val(cid);
  var ddd = $("#baid").val();
  
});


$(document).on("click", ".showAll", function (e) {
    e.preventDefault();
    $(".showingBy").text(`All ${table[0].toUpperCase()+table.slice(1)}`);
    $("#dataTable").attr('data-filter', 'ALL');
    dataTable.ajax.reload();
  });

  $(document).on("click", ".showActive", function (e) {
    e.preventDefault();
    $(".showingBy").text(`Active ${table[0].toUpperCase()+table.slice(1)} `);
    $("#dataTable").attr('data-filter', 'Actived');
    dataTable.ajax.reload();
});

$(document).on("click", ".activateAll", function (e) {
    e.preventDefault();
    ActiontoStatus("activateAll");
  });

  $(document).on("click", ".indexAll", function (e) {
    e.preventDefault();
    ActiontoStatus("indexAll");
  });


  $(document).on("click", ".trashAll", function (e) {
    e.preventDefault();
    ActiontoStatus("trashAll");
  });

  $(document).on("click", ".trash", function (e) {
    e.preventDefault();
    var rowId = $(this).data('id');
    ActiontoStatus("trash", rowId);
  });

  $(document).on("click", ".index", function (e) {
    e.preventDefault();
    var rowId = $(this).data('id');
    ActiontoStatus("index", rowId);
  });

  $(document).on("click", ".activate", function (e) {
    e.preventDefault();
    var rowId = $(this).data('id');
    ActiontoStatus("activate", rowId);
  });

  $(document).on("click", ".delete", function (e) {
    e.preventDefault();
    var rowId = $(this).data('id');
    ActiontoStatus("delete", rowId);
  });
  
        
        
  function ActiontoStatus(type, rowId = '') {
    let title;

    if (type == "activateAll") {
      title = "Activate";
      var selectedRows = dataTable.rows({ selected: true }).data().toArray();
      var ids = selectedRows.map(row => row[0]);
      var count = dataTable.rows({ selected: true }).count();
    } else if(type == 'deleteAll') {
      var selectedRows = dataTable.rows({ selected: true }).data().toArray();
      var ids = selectedRows.map(row => row[0]);
      var count = dataTable.rows({ selected: true }).count();
      title = "Delete";
    } else if (type == "trashAll") {
      title = "Trash";
      var selectedRows = dataTable.rows({ selected: true }).data().toArray();
      var ids = selectedRows.map(row => row[0]);
      var count = dataTable.rows({ selected: true }).count();
    } else if(type == 'trash') {
      var ids = rowId;
      var count = 1;
      title = "Trash";
    } else if(type == 'activate') {
      var ids = rowId;
      var count = 1;
      title = "Activate";
    } else if(type == 'delete') {
      var ids = rowId;
      var count = 1;
      title = "Delete";
    } else if (type == "indexAll") {
      title = "Instant index";
      var selectedRows = dataTable.rows({ selected: true }).data().toArray();
      var ids = selectedRows.map(row => row[0]);
      var count = dataTable.rows({ selected: true }).count();
    } else if(type == 'index') {
      var ids = rowId;
      var count = 1;
      title = "Instant index";
    }

    if (count == 0) {
      Swal.fire("Error", "You Have no Item Seleted for " + title, "warning");
      return false;
    }

    Swal.fire(
    {
        title: "Are you sure to " + title + " Total: " + count + " Items? " ,
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-warning",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true,
    }
).then(function (result) {
    if (result.value) {
        $.ajax({
            type: "post",
            url: `/SHU-Admin/${table}/process`,
            dataType: "json",
            data: {
                ids: ids,
                type: type,
                submit: 'settingStatus',
            },
            success: function (data) {
                if (data.s == "1") {
                    dataTable.draw(false);
                    Swal.fire("Successfully", data.m, "success");
                } else {
                    Swal.fire("Error", data.m, "warning");
                }
            },

            error: function (xhr, status, error) {
              console.error("AJAX Error: " + error);
              Swal.fire("Error", "AJAX Error: " + error, "error");
            }
        });
    } else {
        Swal.fire.close();
    }
});


  }
  $(document).on("submit", "#setting", function(e) {
    e.preventDefault();
  
    const form = this;
    const formData = new FormData(form);
    const overlay = $(".overlay");
    const submitButton = $(form).find("#submit");
    const processUrl = $(form).data('process');
  
    overlay.removeClass("d-none");
    submitButton.prop("disabled", true);
  
    $.ajax({
      url: processUrl + "/process",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
  
      success: function(data) {
        submitButton.prop("disabled", false);
        overlay.addClass("d-none");
  
        if (data.status == 1) {
          Swal.fire({
            title: "Success",
            text: data.message,
            icon: "success",
            didClose: function() {
              location.reload();
            }
          });
        } else {
          Swal.fire({
            title: "Warning",
            text: data.message,
            icon: 'warning'
          });
        }
      },
  
      error: function(xhr, status, error) {
        console.error("AJAX Error: " + error);
  
        submitButton.prop("disabled", false);
        overlay.addClass("d-none");
  
        Swal.fire({
          title: 'Error!',
          text: "AJAX Error: " + error,
          icon: 'error'
        });
      }
    });
  });
  
  


  let editorInstance = null;

  $(document).on("click", ".edit", function (e) {
    e.preventDefault();

    

    var rowId = $(this).data('id');
    var submit = 'getEdit';
    const form = $(this).closest('form');
    var editModal = $('#editmodal');
    var addBookModal = $('#addsmodal');
    var isBook = $(form).find('#isBook').length > 0;
    



    $("#img_preview", editModal).empty();
    $("#authorEdit", editModal).empty();
    $("#author1", editModal).empty();
    $("#compiler", editModal).empty();
    $("#compiler1", editModal).empty();
    $("#groupsEdit", editModal).empty();
    $("#groups1", editModal).empty();
    $("#status-switch", editModal).empty();
    $("#ishome-switch", editModal).empty();
    
    


    function initializeEditor() {
    $.ajax({
        url: `/SHU-Admin/${table}/process`,
        type: "POST",
        dataType: "json",
        data: {
            submit: submit,
            id: rowId,
        },

        success: function(data) {

          
            
          if(table == 'author' || table == 'groups' || table == 'compiler' )  {

            $(".post-title", editModal).val(data.name);
            $(".slug", editModal).val(data.slug);
            $(".postID", editModal).val(data.id);
            $(".hiddenimg", editModal).val(data.image);
            $(".meta-title", editModal).val(data.title);
            $(".meta-desc", editModal).val(data.meta_desc);
            $(".meta-key", editModal).val(data.meta_key);
            $(".hiddenimg_foler", editModal).val(data.img_folder);

            var imgElement = $('<img>');
            imgElement.attr({
                src: "../../Public/thumb"+data.img_folder + "/" + data.image,
                alt: data.name,
                width: 100,
                height: 100,
            });

            

            $("#img_preview").append(imgElement);

          } else if(table == 'blog-cats') {

            $(".post-title", editModal).val(data.name);
            $(".slug", editModal).val(data.slug);
              // Initialize CKEditor and store the instance
              ckeditor(conST(data.description), '#desc2').then(editor => {
                editorInstance = editor;
            }).catch(error => {
                console.error('Error initializing editor:', error);
            });
            $(".postID", editModal).val(data.id);
            $(".hiddenimg", editModal).val(data.image);
            $(".hiddenimg_foler", editModal).val(data.img_folder);

            var imgElement = $('<img>');
            imgElement.attr({
                src: "../../Public/thumb"+data.img_folder + "/" + data.image,
                alt: data.name,
                width: 100,
                height: 100,
            });
            $("#img_preview").append(imgElement);

          } else if(table == 'category' || table == 'page') {
            $(".post-title", editModal).val(data.name);
            $(".slug", editModal).val(data.slug);

  // Initialize CKEditor and store the instance
                ckeditor(conST(data.description), '#desc2').then(editor => {
                    editorInstance = editor;
                }).catch(error => {
                    console.error('Error initializing editor:', error);
                });
            // ckeditor(conST(data.description), '#desc2');
            $(".postID", editModal).val(data.id);
            $(".hiddenimg", editModal).val(data.image);
            $(".meta-title", editModal).val(data.title);
            $(".meta-desc", editModal).val(data.meta_desc);
            $(".meta-key", editModal).val(data.meta_key);
            $(".hiddenimg_foler", editModal).val(data.img_folder);
            // var genres = data.genre.split(",");

          // genres.forEach(function (tag) {
          //   var option = new Option(tag, tag, true, true);
          //   $('#genreEdit').append(option).trigger('change');
          // });

          var imgElement = $('<img>');
          imgElement.attr({
              src: "../../Public/thumb"+data.img_folder + "/" + data.image,
              alt: data.name,
              width: 100,
              height: 100,
          });
          $("#img_preview").append(imgElement);


          } else if(table == 'book') {
            $(".post-title", editModal).val(data.name);
            $(".slug", editModal).val(data.slug);
              // Initialize CKEditor and store the instance
              ckeditor(conST(data.description), '#desc2').then(editor => {
                editorInstance = editor;
            }).catch(error => {
                console.error('Error initializing editor:', error);
            });
            $(".postID", editModal).val(data.id);
            $(".hiddenimg", editModal).val(data.image);
            $(".meta-title", editModal).val(data.title);
            $(".meta-desc", editModal).val(data.meta_desc);
            $(".meta-key", editModal).val(data.meta_key);
            $(".hiddenimg_foler", editModal).val(data.img_folder);
            var author = data.author.split(",");
            var groups = data.groupes.split(",");

            author.forEach(function (tag) {
              var option = new Option(tag, tag, true, true);
              $('#authorEdit').append(option).trigger('change');
            });

            groups.forEach(function (tag) {
              var option = new Option(tag, tag, true, true);
              $('#groupsEdit').append(option).trigger('change');
            });

          var imgElement = $('<img>');
          imgElement.attr({
              src: "../../Public/thumb/182x268"+data.img_folder + "/" + data.image,
              alt: data.name,
              width: 70,
              height: 100,
          });
          $("#img_preview").append(imgElement);
          } else if(table == 'ebook') {
            $(".post-title", editModal).val(data.name);
            $(".slug", editModal).val(data.slug);
              // Initialize CKEditor and store the instance
              ckeditor(conST(data.description), '#desc2').then(editor => {
                editorInstance = editor;
            }).catch(error => {
                console.error('Error initializing editor:', error);
            });
            $(".postID", editModal).val(data.id);
            $(".hiddenfile", editModal).val(data.file_name);
            $(".hiddenfilefoler", editModal).val(data.file_dir);
            $(".hiddenimg", editModal).val(data.image);
            $(".ext", editModal).val(data.ext);
            $(".meta-title", editModal).val(data.title);
            $(".meta-desc", editModal).val(data.meta_desc);
            $(".meta-key", editModal).val(data.meta_key);
            $(".hiddenimg_foler", editModal).val(data.img_folder);
            $(".size", editModal).val(data.size);
            $(".phone", editModal).val(data.phone);
            var author = data.author.split(",");
            var groups = data.groupes.split(",");
            var compiler = data.compiler.split(",");


            author.forEach(function (tag) {
              var option = new Option(tag, tag, true, true);
              $('#authorEdit').append(option).trigger('change');
            });

            compiler.forEach(function (tag) {
              var option = new Option(tag, tag, true, true);
              $('#compiler1').append(option).trigger('change');
            });

            groups.forEach(function (tag) {
              var option = new Option(tag, tag, true, true);
              $('#groupsEdit').append(option).trigger('change');
            });

          var imgElement = $('<img>');
          imgElement.attr({
              src: "../../Public/thumb/182x268"+data.img_folder + "/" + data.image,
              alt: data.name,
              width: 70,
              height: 100,
          });
          $("#img_preview").append(imgElement);
          } else if(table == 'blog') {

            $(".post-title", editModal).val(data.name);
            $(".slug", editModal).val(data.slug);
              // Initialize CKEditor and store the instance
              ckeditor(conST(data.description), '#desc2').then(editor => {
                editorInstance = editor;
            }).catch(error => {
                console.error('Error initializing editor:', error);
            });
            $(".postID", editModal).val(data.id);
            $(".hiddenfile", editModal).val(data.file_name);
            $(".hiddenfilefoler", editModal).val(data.file_dir);
            $(".hiddenimg", editModal).val(data.image);
            $(".ext", editModal).val(data.ext);
            $(".meta-title", editModal).val(data.title);
            $(".meta-desc", editModal).val(data.meta_desc);
            $(".meta-key", editModal).val(data.meta_key);
            $(".hiddenimg_foler", editModal).val(data.img_folder);

            var imgElement = $('<img>');
            imgElement.attr({
                src: "../../Public/thumb"+data.img_folder + "/" + data.image,
                alt: data.name,
                width: 100,
                height: 100,
            });
            $("#img_preview").append(imgElement);
          }

          





createSwitchElements("status-switch", "statuss", "status", "Status", data.status === 1);
createSwitchElements("ishome-switch", "homes", "isHome", "Add to Home", data.isHome === 1);
createSwitchElements("istrend-switch", "trend", "isTrend", "Trend", data.isTrend === 1);
createSwitchElements("isdownload-switch", "download", "isDownload", "Download", data.isDownload === 1);
createSwitchElements("isread-switch", "read", "isRead", "Read", data.isRead === 1);
createSwitchElements("isfree-switch", "Free", "Free", "Free", data.isFree === 1);


              
        }
    });
  }

    // Destroy previous CKEditor instance if it exists
    if (editorInstance) {
      editorInstance.destroy()
          .then(() => {
              editorInstance = null; // Reset the instance reference
              initializeEditor();
          })
          .catch(error => {
              console.error('Error destroying editor:', error);
              initializeEditor(); // Try to initialize editor even if destroy fails
          });
  } else {
      initializeEditor(); // Initialize editor if no previous instance
  }


    
  });

  $('#filetype').change(tfile);
  $('#edit-filetype').change(tfile);
  $('.imagetype').change(tImage);
  $('#edit-imagetype').change(tImage);
  $('#edit-filetype').change(tImage);

});

$(document).on("click", '.show-review', function(e) {
  e.preventDefault();

  const content = $(this).data('content');
  const id = $(this).data('id');
  const file_id = $(this).data('file_id');


   $("#id").val(id);
   $("#file_id").val(file_id);
   $("#content").html(content);
   $("#view").modal('show');

});


       
function createSwitchElements(containerId, checkboxId, checkboxName, labelText, isChecked) {
  var switchCont = $("<div>", {
      class: "custom-switch custom-switch-label-status pl-0 ml-3"
  });

  var checkbox = $("<input>", {
      class: "custom-switch-input",
      type: "checkbox",
      id: checkboxId,
      name: checkboxName,
  });

  checkbox.prop("checked", isChecked);
  var label = $("<label>", {
      class: "custom-switch-btn",
      for: checkboxId
  });

  var flabel = $("<label>", {
      class: "form-check-label m-3",
      for: checkboxId,
      text: labelText
  });

  switchCont.append(flabel, checkbox, label);
  $("#" + containerId).empty().append(switchCont);
} 

function tImage() {
  var form = $(this).closest('form');
  var imagetype = $(form).find(".imagetype");
  var fileShow = $(form).find("#file_show");
  var urlShow = $(form).find("#url_show");


  var imagetype1 =  $(form).find("#edit-imagetype");
  var fileShow1 =  $(form).find("#edit-file_show");
  var urlShow1 =  $(form).find("#edit-url_show");

  if (imagetype.val() === "FILE") {
      fileShow.show();
      urlShow.hide();
  } else if (imagetype.val() === "URL") {
      fileShow.hide();
      urlShow.show();
  }

  if (imagetype1.val() === "FILE") {
      fileShow1.show();
      urlShow1.hide();
  } else if (imagetype1.val() === "URL") {
      fileShow1.hide();
      urlShow1.show();
  }
}

function tfile() {
  var form = $(this).closest('form');
  var imagetype = $(form).find("#filetype");
  var fileShow = $(form).find("#local_file_show");
  var urlShow = $(form).find("#file_url_show");



  var imagetype1 = $(form).find("#edit-filetype");
  var fileShow1 = $(form).find("#edit-local_file_show");
  var urlShow1 = $(form).find("#edit-file_url_show");

  if (imagetype.val() === "FILE") {
      fileShow.show();
      urlShow.hide();
  } else if (imagetype.val() === "URL") {
      fileShow.hide();
      urlShow.show();
  }

  if (imagetype1.val() === "FILE") {
      $(fileShow1).show();
      $(urlShow1).hide();
  } else if (imagetype1.val() === "URL") {
      fileShow1.hide();
      urlShow1.show();
  }
}




  function conST(str) {
    var e = document.createElement('div');
    e.innerHTML = str;
    return e.innerText;
  }
  
  

