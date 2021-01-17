$(function(){
$('.multiple-items').slick({
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  focusOnSelect:true,
});
  

});

$(function(){ 
	$('#big_img').Jcrop({
		aspectRatio: 1, 
		minSize: [50, 50],
		setSelect:   [ 100, 100, 50, 50 ],
        onSelect: showCoords,
        onChange: showCoords

	}); 
});

function showCoords(c){
	console.log(c);
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}