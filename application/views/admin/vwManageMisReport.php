<style>
div#gridTable_filter {
   display: inline-block;
    text-align: center;
    margin: 0 auto;
    position: absolute;
    left: 40%;
}
</style>
<section class="content-header">
    <div class="headertitle">
      <h1>
       <?=$pagetitle?>
      </h1>
    </div>
    
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
          <?
		  $this->load->view('admin/controls/vwMessage');
		  
		  ?>
          <div id="delete_allmsg_div"></div>
            
          </div>
          <div class="custome_filter">
          
         	  <div class="col-md-4">
          		<label for="course_name" class="control-label"><span class="required">*</span>Course</label>
                
                   <select class="form-control" name="course_name" id="course_name">
                    	<option value="">--Select Course--</option>
                        <? foreach($course as $course_val){ ?>
                    	<option value="<?=$course_val["course_id"]?>"><?=$course_val["course_name"]?></option>
                    	<? } ?>
                    </select>
                    <span class="error" id="lblcourse"></span>
               </div>
              <div class="col-md-4">  
                <label for="cast_name" class="control-label">Demography</label>
                
                   <select class="form-control" name="cast_name" id="cast_name">
                    	<option value="">--Select Demography--</option>
                    	<option value="APL">APL</option>
                    	<option value="BPL">BPL</option>
                    	<option value="SC &amp; ST">SC &amp; ST </option>
                    </select>
              </div> 
              <div class="col-md-4">  
                <label for="gender" class="control-label">Gender</label>
                
                   <select class="form-control" name="gender" id="gender">
                    	<option value="">--Select Gender--</option>
                    	<option value="Male">Male</option>
                    	<option value="Female">Female</option>
                    	<option value="Other">Other </option>
                    </select>
              </div> 
              <div class="col-md-12">
              <div class="age_from_div">
          		<label for="age_from" class="control-label">Age From</label>
                <input type="text" class="form-control TextCenter" maxlength="2" style="max-width:50px;" name="age_from" id="age_from" onkeypress="return numericOnly(this);" autocomplete="off">
                </div>
                <div class="age_to_div">
                <label for="age_to" class="control-label">Age To</label>
                <input type="text" class="form-control TextCenter" maxlength="2" style="max-width:50px;"  name="age_to" id="age_to" onkeypress="return numericOnly(this);" autocomplete="off">
                </div>
                <span class="error" id="lblage"></span>
               </div>
               
               <div class="col-md-12">
               <div class="filter-button">
                  <button class="button radius" onclick="return Search();">Search</button>
                   
                   <a href="<?=base_url();?>admin/mis_reports" class="button radius">Reset</a>
                 </div>
                  </div>
                  
              
          </div>
          <div class="box-body">
         
            <table id="gridTable" class="table table-bordered table-striped">
              <thead>
                <tr>
               
				  <th  width="5%">ID</th>
                  <th  width="10%">Name</th>
                  <th  width="10%">Father</th>
                  <th  width="5%">Gender</th>
                  <th  width="5%">Age</th>
                  <th  width="10%">Village</th>
                  <th  width="10%">Post</th>
                  <th  width="10%">District </th>
                  <th  width="10%">State </th>
                  <th  width="10%">Demography</th>
                  <th  width="15%">Course Name</th>
            
                                  
                </tr>
              </thead>
            </table>
            
          </div>
        </div>
      </div>
    </div>
</section>
<script>
function Search()
{
	
			var arrTmp=new Array();
			var i;
			_blk=true;
			
			arrTmp[0]=checkCourse();
			arrTmp[1]=checkAge();
			
			
			
			
			
			
				
			for(i=0;i<arrTmp.length;i++)
			{
				if(arrTmp[i]==false)
				{
					_blk=false;
				}
			}
			
			if(_blk==true)
			{  
				
				dataTable.fnDraw();
			}
			else
			{	
				return false;
			}
		
	
	
}
function checkCourse()
{
	
	if(document.getElementById('course_name').value =="")
	{
		document.getElementById('lblcourse').innerHTML="Please select course.";
		return false;	
	}
	else
	{
		document.getElementById('lblcourse').innerHTML="";
		return true;
	}
}
function checkAge()
{
	age_from=document.getElementById('age_from').value;
	age_to=document.getElementById('age_to').value
	if(age_from > age_to)
	{
		document.getElementById('lblage').innerHTML="<br />Please enter Age from less than Age to.";
		return false;	
	}
	else
	{
		document.getElementById('lblage').innerHTML="";
		return true;
	}
}
</script>