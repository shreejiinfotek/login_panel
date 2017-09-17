<? if(count($faq)>0) {?>

<? $faq_length = strlen($faq->faq_answer); ?>
<p><?=$this->common->closetags($this->common->GetshortString($faq->faq_answer,600))?></p>
<? if($faq_length>600){ ?>
<p> <a href="<?=base_url()."faqs/".$faq->faq_id?>" class="read-more1">Read more <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
<? } ?>

<? } else {?>
<div class="no-found">Sorry, no faq found.</div>
<? }?>