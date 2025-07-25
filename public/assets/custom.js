$(document).ready(function(){

    // filter value
    $(document).on('click', '.get_filter_val', function(){
        
        var selected_year = $('#year').val();
        var selected_month = $('#month').val();

        if(selected_year != '' && selected_month != ''){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:baseUrl + '/attn/filter',
                data:{filter_val:selected_year + '-' + selected_month},
                dataType:'json',
                beforeSend: function() {
                    $('#loader').show();
                },

                success:function(response){
                    $('.attn_table').html(response.html);
                },

                complete: function() {
                    $('#loader').hide();
                },
            });
        }
    });

    // checked box value
    $(document).on('click', '.checked_box', function(){
        
        if($(this).is(':checked')){
            $(this).prop('checked', true);
        }

        if($('.checked_box:checked').length !== $('.checked_box').length){
            $('.checked_all').prop('checked', false);
        }else{
            $('.checked_all').prop('checked', true);
        }

    });

    // checked all value
    $(document).on('click', '.checked_all', function(){
        if($(this).is(':checked')){
            $('.checked_box').prop('checked', true);
            
        }else{
            $('.checked_box').prop('checked', false);
        }
    });

    // mark attenence
    $(document).off('click', '.mark_attenence').on('click', '.mark_attenence', function(e){
        e.preventDefault();
        // alert('Hare Krishna');
        var checkedVals = $('.checked_box:checkbox:checked').map(function() {
            return this.value;
        }).get();
        var data_href = $(this).attr('data-href');

        if(checkedVals.length != 0){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:data_href,
                data:{checkedVals},
                dataType:'json',

                beforeSend: function() {
                    $('#loader').show();
                },

                success:function(response){
                    $('.attn_table').html(response.html);
                },

                complete: function() {
                    $('#loader').hide();
                },
            });
        }


    });
});