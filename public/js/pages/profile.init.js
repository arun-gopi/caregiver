

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

   $(document).ready(function(){

     $( "#icd10_search" ).autocomplete({
        source: function( request, response ) {
           // Fetch data
           $.ajax({
             url:'/geticds',
             type: 'get',
             dataType: "json",
             data: {
                _token: CSRF_TOKEN,
                search: request.term
             },
             success: function( data ) {
                response( data );
             }
           });
        },
        select: function (event, ui) {
          $('#ICD10').val(ui.item.value); // display the selected text
          $('#ICD10Description').val(ui.item.label); // save selected id to input
          $('#icd10_search').val(""); // save selected id to input
          return false;
        }
     });

   //   $('.comedit').on("click",function(){
   //    alert('You clicked the edit button!')
         // post code
   //  })

   //  $('.comdelete').on("click",function(){
   //    alert('You clicked the Delete button!')
         // post code
   //  })

   });

