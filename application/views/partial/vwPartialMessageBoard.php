                    <div class="col-sm-8">
                    	<h1 class="BT30"><?=$content->page_title?></h1>
                         <?=$content->page_description;?>
                        <?
						$x_message_board_by_title=$message_board_by_title;
							if(count($x_message_board_by_title)>0)
							{
								?>
                        <div class="swiper-container swiper-message-list">
                            <div class="swiper-wrapper">
                            
                            <?
							
							$message_board_count=0;
							foreach($x_message_board_by_title as $message_board_by_title_val):
							?>
                            	<div class="swiper-slide">
                    				<div class="col-md-12 slider open-sans">
                                    	<p><b><?=$message_board_by_title_val['message_board_multiple_question']?>?</b></p>
                                        <div>
										<input type="hidden" value="<?=$message_board_by_title_val['message_board_title_id'];?>" id="hid_message_board_title_id" />
                                        <input type="hidden" value="<?=$message_board_by_title_val['message_board_id'];?>" id="hid_message_board_id<?=$message_board_by_title_val['message_board_title_id'].$message_board_count;?>" />
                                        <a href="#">Posted by Administrator </a><span>|</span>
                                        <a href="#">
                                        <?
										$datetime1 = new DateTime($message_board_by_title_val['created_date']);
										$datetime2 = new DateTime("now");
										$interval = $datetime1->diff($datetime2);								
										if($interval->format('%R%a') == 0) {
											echo 'Today';
										} else if($interval->format('%R%a') == 1) {
											echo 'A Day ago';
										} else if($interval->format('%R%a') > 1) {
											echo $interval->format('%a').' Days ago';
										} else if($interval->format('%R%a') == -1) {
											echo 'After '.$interval->format('%a').' Day';	
										} else {
											echo 'After '.$interval->format('%a').' Days';	
										}
										?>
                                        </a><span>|</span><a id="parent_count_load<?=$message_board_by_title_val['message_board_id'];?>" href="#"></a>
                                        </div>
                    				</div>
                                 </div>
                            <?
							$message_board_count++;
							endforeach;
							?>
                             </div>  
                             <!--<div class="swiper-pagination"></div> -->
                             <div class="swiper-msg-prev"></div>
						     <div class="swiper-msg-next"></div>
                             
                                             
                    	</div>
                        <div class="post-content">
                            <form id="MessageBoardForam" method="post">
                            <?
							if($this->session->userdata('user_id'))
							{
								$disable="";
							}
							else
							{
								$disable='disabled="disabled"';
							}
							?>
                                 <input <?=$disable?> name="comments" onkeyup="enable_post_button(this.value,'');" id="comments" type="text" placeholder="Write Something.." class="textbox"><input disabled id="comments_btn" type="button" value="POST" class="button" onclick="message_board_comment('comments','');">
                                 <input type="hidden" name="message_board_id" id="message_board_id" />
                                 <input type="hidden" name="message_board_title_id" id="message_board_title_id" />
                                 <input type="hidden" value="0" name="parent_comment_id" id="parent_comment_id" />
                            </form>
                        </div> 
                        <?
							}
							else
							{
								?>
								<div class="no-found">Sorry, no message board found.</div>
                                <?
							}
						?>
                        
                        <div class="members MT50" id="message_board_comments"> 
                           
                         </div>
                        </div>
<script>

</script>