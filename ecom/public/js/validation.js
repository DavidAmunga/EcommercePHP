$(function()
{
 $.validator.setDefaults(
 {
errorClass:'help-block',
highlight:function(element){
    $(element)
    .closest('.form-group')
    .addClass('has-error');
},
unhighlight:function(element){
    $(element)
    .closest('.form-group')
    .removeClass('has-error');
},
errorPlacement: function(error,element){
if(element.prop('type')==='checkbox')
{
error.insertAfter(element.parent());
}
else{
error.insertAfter(element);
}

}
 });
 $.validator.addMethod('strongPassword',function(value,element){
return this.optional(element)
|| value.length>=6
&& /\d/.test(value)
&& /[a-z]/i.test(value);

 },
'Your password must be at least 6 characters long and contain at least one number and one char\'.')

 $("#register-form").validate({
     rules:
     {
         user_email:{
             required:true,
             email:true
         },
         user_password:
         {
             required:true,
             strongPassword:true
         },
         password2:
        {
            required:true,
            equalTo:"#password"
        },

         user_first_name:
         {
        required:true,
        nowhitespace:true,
        lettersonly:true
         },

        user_last_name:
         {
        required:true,
        nowhitespace:true,
        lettersonly:true
         },
         user_surname:
         {
        required:true,
        nowhitespace:true,
        lettersonly:true
         },
         user_age:
         {
        required:true,
        nowhitespace:true,

         },
         user_surname:
         {
        required:true,
        nowhitespace:true,

         },
         user_mobile_no:
         {
        required:true,
        nowhitespace:true,

         },

         user_address:
         {
        required:true,

         }
         ,

         username:
         {
        required:true,
        nowhitespace:true,
        lettersonly:true
         }


     },

     messages:
        {
            user_email:
            {
            required:'Please enter an Email Address',
            email: 'Please enter a valid email Address'
            }
            ,
            user_first_name:
            {
            required:'Please enter your First Name',

            }
            ,
            user_last_name:
            {
            required:'Please enter your Last Name',

            }
            ,
            user_address:
            {
            required:'Please enter your Address',

            }
            ,
            user_surname:
            {
            required:'Please enter your Surname',

            }
            ,
            username:
            {
            required:'Please enter your Username',

            }
            ,
            user_mobile_no:
            {
            required:'Please enter your Mobile No',

            },
            user_age:
            {
            required:'Please enter your Age',

            }
        }
 });

$("#login-form").validate({
     rules:
     {

         password:
         {
             required:true,
             strongPassword:true
         },


         username:
         {
        required:true,
        nowhitespace:true,
        lettersonly:true
         }


     },

     messages:
        {
            username:
            {
            required:'Please enter an Username',

            }
        }
 });
});



