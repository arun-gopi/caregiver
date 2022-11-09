/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Form mask Js File
*/

$(document).ready(function(){
    $('.ssn-mask').inputmask('999-99-9999');
    $('.mobile-mask').inputmask('(999) 999-9999');
    $('.homephone-mask').inputmask('(999) 999-9999');
    $('.zip-mask').inputmask('99999[-9999]');
});