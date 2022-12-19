function _ajax(url, method, data){
    let result;

    $.ajax({
        url: url,
        method: method,
        data: data,
        async: false,
        success: function( response ) {
            result = response;
        }
    });
    
    return result;
}

$(function(){
    $('.modify-annotation-button' ).click(function (e) { 
        e.preventDefault();

        let this_parents_track_li = $(this).parents( '.track-li' );

        let id = this_parents_track_li.find( 'input[type=hidden][name=id]' ).val();
        let title = this_parents_track_li.find( 'div[name=title]' ).html().trim();
        let description = this_parents_track_li.find( 'div[name=description]' ).html().trim();
        let image =this_parents_track_li.find( 'img[name=image]' ).attr('src');
        let annotation =this_parents_track_li.find( 'div[name=annotation]' ).html().trim();

        $( '#modifyAnnotationModalId' ).val(id);
        $( '#modifyAnnotationModalTitle' ).text(title);
        $( '#modifyAnnotationModaldescription' ).text(description);
        $( '#modifyAnnotationModalImageUrl' ).val(image);
        $( '#modifyAnnotationModalAnnotation' ).val(annotation);
    });

    $( '#modifyAnnotationModalButton' ).click(function (e) { 
        e.preventDefault();

        let id = $( '#modifyAnnotationModalId' ).val();
        let annotation = $( '#modifyAnnotationModalAnnotation' ).val();

        let url = base_path + '/playlists/new-hits/show/track';
        let method = 'PUT';
        let key = $('#key').val();
        let data = {
            '_token': key,
            'id': id,
            'annotation': annotation
        };

        let result = JSON.parse(_ajax(url, method, data));
        if(result.status == 200){
            $( `#annotation${id}` ).html(result.data.annotation);
            $( '#modifyAnnotationModalCloseButton' ).trigger('click');
        }
    });


    $('.delete-track-button' ).click(function (e) { 
        e.preventDefault();

        if(!confirm(confirm_message)){
            return false;
        }

        let this_parents_track_li = $(this).parents( '.track-li' );

        let id = this_parents_track_li.find( 'input[type=hidden][name=id]' ).val();

        let url = base_path + '/playlists/new-hits/show/track';
        let method = 'DELETE';
        let key = $('#key').val();
        let data = {
            '_token': key,
            'id': id,
        };

        let result = JSON.parse(_ajax(url, method, data));
        if(result.status == 200){
            console.log(this_parents_track_li.length)
            if($( '.track-li' ).length <= 1){
                $('ol.list-group').remove();
            }else{
                this_parents_track_li.remove();
            }
        }

    });
});