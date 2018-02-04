

// //SHARES
// $('.face-share-btn').on('click', function(e){
//   e.preventDefault;
//   var url = $(this).data('url');
//   //window.open('https://www.facebook.com/sharer/sharer.php?u='+url, 'faceshare', 'width=550,height=500');
//   FB.ui({
//     method: 'share',
//     href: url,
//   }, function(response){})
// });

// $('.whatsapp-share-btn').on('click', function(e){
//   e.preventDefault;
//   if(mobileCheck) {
//     document.location.href = 'whatsapp://send?text=' + $(this).data('title') + ' ' + $(this).data('desc') + ' ' + $(this).data('url');
//   }
//   else {
//     window.open('https://web.whatsapp.com/send?text=' + $(this).data('title') + ' ' + $(this).data('url'), '_blank');
//   }

// });

// $('.link-share-btn').on('click', function(e){
//   e.preventDefault;
//   var url = $(this).data('url');
//   window.open(url, 'linkshare', 'width=975,height=740');
// });

// $('.twitter-share-btn').on('click', function(e){
//   e.preventDefault;
//   var url = $(this).data('url');
//   window.open('https://twitter.com/intent/tweet?text='+url, 'twittshare', 'width=550,height=500');
// });
