(function($){
  // Uploading files
  var file_frame;

  $('.widgets-holder-wrap').on('click', '.media-library-trigger', function( event ){
    event.preventDefault();
    var trigger = $(this);

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.options.trigger = trigger;
      file_frame.open();
      return;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: $( this ).data( 'uploader_title' ),
      button: {
        text: $( this ).data( 'uploader_button_text' ),
      },
      multiple: false,  // Set to true to allow multiple files to be selected
      trigger: trigger
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      var trigger = file_frame.options.trigger;
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();
      var wrapper = trigger.closest('.widget-content')

      var outputElement = wrapper.find('#'+trigger.data('target'));
      var image = wrapper.find('#'+outputElement.data('image'));

      if (outputElement) {
        outputElement.val(attachment.url);
      }

      if (image) {
        image.attr('src', attachment.url);
      }
      // Do something with attachment.id and/or attachment.url here
    });

    // Finally, open the modal
    file_frame.open();
  });


  $(document).on('ready', function() {
    $('.widget').on('click','.widget_update', function() {
      var widget = $(this).closest('.widget');
      $(this).closest('.spinner').show();
      wpWidgets.save(widget);
    })
  });
})(jQuery);