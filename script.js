$(function () {
  var $iframe = $( 'iframe' );
  $iframe.autoHeight();

  // Test height change:
  setTimeout(function() {
    for ( var i = 0; i < 2000; i++ ) {
      $( 'body', $iframe.contents() )
        .append( '<h1>Added content.</h1>' );
    }
  }, 3000);
});
