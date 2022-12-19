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
    $('.track-button' ).click(function (e) { 
        e.preventDefault();

        let this_parents_track_li = $(this).parents( '.track-li' );

        let id = this_parents_track_li.find( 'input[type=hidden][name=id]' ).val();
        let title = this_parents_track_li.find( 'div[name=title]' ).html().trim();
        let description = this_parents_track_li.find( 'div[name=description]' ).html().trim();
        let image =this_parents_track_li.find( 'img[name=image]' ).attr('src');

        $( '#trackingListModalId' ).val(id);
        $( '#trackingListModalTitle' ).text(title);
        $( '#trackingListModaldescription' ).text(description);
        $( '#trackingListModalImageUrl' ).val(image);
    });

    $( '#trackingListModalButton' ).click(function (e) { 
        e.preventDefault();

        let id = $( '#trackingListModalId' ).val();
        let title = $( '#trackingListModalTitle' ).html().trim();
        let description = $( '#trackingListModaldescription' ).html().trim();
        let image_url = $( '#trackingListModalImageUrl' ).val();
        let annotation = $( '#trackingListModalAnnotation' ).val();

        let url = base_path + '/playlists/new-hits/show/track';
        let method = 'POST';
        let key = $('#key').val();
        let data = {
            '_token': key,
            'id': id,
            'title': title,
            'description': description,
            'image_url': image_url,
            'annotation': annotation
        };

        let result = JSON.parse(_ajax(url, method, data));
        if(result.status == 200){
            $( `.track-button${id}` ).prop('disabled', true).html(tracked);
            $( '#trackingListModalCloseButton' ).trigger('click');
        }
    });
});