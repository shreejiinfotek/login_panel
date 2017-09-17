function contact_randomnum()
{
var number1 = 5;
var number2 = 50;
var randomnum = (parseInt(number2) - parseInt(number1)) + 1;
var rand1 = Math.floor(Math.random()*randomnum)+parseInt(number1);
var rand2 = Math.floor(Math.random()*randomnum)+parseInt(number1);
$("#contact_rand1").html(rand1);
$("#contact_rand2").html(rand2);
$("#contact_random_num_first").val(rand1);
$("#contact_random_num_second").val(rand2);
}
$(document).ready(function(){
contact_randomnum();
});