<?
$message_board_comments_count=0;
foreach($message_board_comments as $message_board_comments_val):
?>

<div class="row MT30">
                            <div class="col-md-2 col-sm-2 col-xs-2">
                            <?
							if($message_board_comments_val['register_user_profile_picture']!="")
							{
								$user_profile_picture=base_url().$message_board_comments_val['register_user_profile_picture'];
							}
							else
							{
								$user_profile_picture=HTTP_ASSETS_PATH_CLIENT.'images/msg_profile_pic.png';
							}
							?>
                                <img src="<?=$user_profile_picture?>" alt="msg1" class="img-responsive">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10">    
                                <div class="msg_border">
                                    <p><?=$message_board_comments_val['comments']?></p>
                                    <p class="post_details">Posted by <?=$message_board_comments_val['register_user_first_name'].' '.$message_board_comments_val['register_user_last_name']?><span class="MRL">|</span>
                                    <?
										$datetime1 = new DateTime($message_board_comments_val['comment_date']);
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
										if($message_board_comments_count==0)
										{
											$comment="comment";
											$reply="reply";
										}
										else
										{
											$comment="comment".$message_board_comments_count."";
											$reply="reply".$message_board_comments_count."";
										}
										?>
                                    <span class="MRL">|</span><a href="#<?=$comment?>" data-toggle="collapse">Comment (<?=$this->common->CountByTable('message_board_comment','WHERE message_board_title_id='.$message_board_comments_val['message_board_title_id'].' AND message_board_id='.$message_board_comments_val['message_board_id'].' AND parent_comment_id='.$message_board_comments_val['message_board_comment_id'].'');?>)</a><span class="MRL">|</span><a href="#<?=$reply?>" data-toggle="collapse">Reply</a></p>
                                    <?
									foreach($message_board_child_comments as $message_board_child_comments_val):
									if($message_board_child_comments_val['parent_comment_id']==$message_board_comments_val['message_board_comment_id'])
									{
									?>
                  					<div id="<?=$comment?>" class="collapse">
										<div class="comment_open MT30">
                                        <?
										foreach($message_board_child_comments as $message_board_child_comments_val):
										if($message_board_child_comments_val['parent_comment_id']==$message_board_comments_val['message_board_comment_id'])
										{
										?>
                                        	<div class="row">
                                            	<div class="col-md-1 col-sm-1 col-xs-1">
                                                <?
												if($message_board_child_comments_val['register_user_profile_picture']!="")
												{
													$user_player_profile_picture=base_url().$message_board_child_comments_val['register_user_profile_picture'];
												}
												else
												{
													$user_player_profile_picture=HTTP_ASSETS_PATH_CLIENT.'images/msg_profile_pic_small.png';
												}
												?>
		                                        	<img src="<?=$user_player_profile_picture?>" alt="msg" class="img-responsive">
                                                </div>
                                                <div class="col-md-10 col-sm-10 col-xs-10">
                                                	<p class="sub_cmt"><!--<span class="orange"><b>Rot harum quidem</b></span>--> <?=$message_board_child_comments_val['comments']?></p>
                                                    <p class="post_details1">Posted by <?=$message_board_child_comments_val['register_user_first_name'].' '.$message_board_child_comments_val['register_user_last_name']?><span class="MRL">|</span>
                                                    <?
													$datetime1 = new DateTime($message_board_child_comments_val['comment_date']);
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
                                                    </p>
                                                </div>    
                                            </div>
                                            <?
										}
											endforeach;
											?>
                                        </div>
                                      </div>
                                      <?
									  break;
									}
									  endforeach;
									  ?>
                                      <div id="<?=$reply?>" class="collapse">
                                        <div class="post-content1">
                             				<form id="MessageBoardReplyForam<?=$message_board_comments_val['message_board_comment_id']?>" method="post">
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
                                            
                                        	<input <?=$disable?> type="text" onkeyup="enable_post_button(this.value,'<?=$message_board_comments_val['message_board_comment_id']?>');" name="comments" id="comments" placeholder="Write Something.." class="textbox"><input disabled type="button" value="POST" id="comments_btn<?=$message_board_comments_val['message_board_comment_id']?>" class="button" onclick="message_board_comment('reply',<?=$message_board_comments_val['message_board_comment_id']?>);">
                                            <input type="hidden" name="message_board_id" id="message_board_id" value="<?=$message_board_comments_val['message_board_id']?>" />
                                            <input type="hidden" name="message_board_title_id" id="message_board_title_id" value="<?=$message_board_comments_val['message_board_title_id']?>" />
                                            <input type="hidden" value="<?=$message_board_comments_val['message_board_comment_id']?>" name="parent_comment_id" id="parent_comment_id" />   
                                			</form>
				                        </div>
                                      </div>
                                    </div>
                                </div>
                           </div>
<?
$message_board_comments_count++;
endforeach;
?>