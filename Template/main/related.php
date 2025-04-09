<div class="col-12">
						<div class="series-wrap">
							<h3 class="series-wrap__title"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M9,10a1,1,0,0,0-1,1v2a1,1,0,0,0,2,0V11A1,1,0,0,0,9,10Zm12,1a1,1,0,0,0,1-1V6a1,1,0,0,0-1-1H3A1,1,0,0,0,2,6v4a1,1,0,0,0,1,1,1,1,0,0,1,0,2,1,1,0,0,0-1,1v4a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V14a1,1,0,0,0-1-1,1,1,0,0,1,0-2ZM20,9.18a3,3,0,0,0,0,5.64V17H10a1,1,0,0,0-2,0H4V14.82A3,3,0,0,0,4,9.18V7H8a1,1,0,0,0,2,0H20Z"></path></svg> Related Novels</h3>
							<div class="section__carousel-wrap">
								<div class="section__series owl-carousel owl-loaded owl-drag" id="series">
									

									

									

									

									

									
								<div class="owl-stage-outer owl-height" style="height: 207.516px;"><div class="owl-stage" style="transform: translate3d(-1420px, 0px, 0px); transition: all 1.8s ease 0s; width: 2841px;">
                                
                                <?php

                                foreach($relatedFiles as $row) {

                                    if(empty($row['image'])) {
                                        $image = APP_URL.'/Public/assets/main/img/author.jpg';
                                    } else {
                                        $image = APP_URL.'/Public/thumb/'.$row['img_folder'].'/'.$row['image'];
                                    }
    

                                    echo ' <div class="owl-item" style="width: 216.667px; margin-right: 20px;"><div class="series">
                                    <a href="'.APP_URL.'/'.$row['slug'].'" class="series__cover">
                                        <img src="'.APP_URL.'/Public/thumb/225x325'.$row['img_folder'].'/'.$row['image'].'" alt="'.$row['name'].'">
                                       
                                    </a>
                                    <h3 class="series__title"><a href="'.APP_URL.'/'.$row['slug'].'">'.$row['name'].'</a></h3>
                                </div></div>';
                                }
                                    ?>
                                </div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div></div>

								<button class="section__nav section__nav--series section__nav--prev" data-nav="#series" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.25 7.72559L16.25 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.2998 1.70124L1.2498 7.72524L7.2998 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
								<button class="section__nav section__nav--series section__nav--next" data-nav="#series" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.75 7.72559L0.75 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.7002 1.70124L15.7502 7.72524L9.7002 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
							</div>
						</div>
					</div>