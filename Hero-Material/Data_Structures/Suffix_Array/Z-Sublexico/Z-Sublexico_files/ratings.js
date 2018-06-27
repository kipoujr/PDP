
star = {};
stars = Array;

star.mousemove = function(which, e) { 

  meStar = $(which + "_star_me");

  if (meStar) {
    
    dx = Event.pointerX(e) - Element.cumulativeOffset(meStar).left;

    sx = Math.ceil(dx*5/84);
    if (sx < 1)
      sx = 1;
    if (sx > 5)
      sx = 5;

    Element.setStyle(meStar, 
                     { visibility: "visible",
                       width : (sx*17) +"px"});

    Element.setStyle($(which + '_star_cur'), 
                     { visibility: "hidden"});


    $(which + '_txt').update('Vote ' + sx);

  }
};


star.mouseout = function(which, e) { 

  meStar = $(which + "_star_me");

  if (meStar) {
    
    dx = Event.pointerX(e) - Element.cumulativeOffset(meStar).left;
    dy = Event.pointerY(e) - Element.cumulativeOffset(meStar).top;

    if (dx > 90 || dy > 20 || dx < 0 || dy < 0) {

      Element.setStyle(meStar, 
                       { visibility: "hidden"});
      
      Element.setStyle($(which + '_star_cur'), 
                       { visibility: "visible",
                         width: stars[which].pixels + 'px'});
      

      $(which + '_txt').update(stars[which].value + ' (' + stars[which].totvot + ' votes)');
    }

  }
};


star.updateNew = function(which) {

  meStar = $(which + "_star_me");
  Element.setStyle(meStar, { visibility: "hidden"});      
  Element.setStyle($(which + '_star_cur'), { visibility: "visible",
                                             width: stars[which].pixels + 'px'});
  $(which + '_txt').update(stars[which].value + ' (' + stars[which].totvot + ' votes)');

}

star.update = function(which, e, refId, typeId) { 

  meStar = $(which + "_star_me");
  
  if (meStar) {
    
    dx = Event.pointerX(e) - Element.cumulativeOffset(meStar).left;
    
    sx = Math.ceil(dx*5/84);
    if (sx < 1)
      sx = 1;
    if (sx > 5)
      sx = 5;

    new Ajax.Request('stars_ajax.php?refId='+refId+'&typeId='+typeId+'&rnd='+which+'&vote='+sx, {
        evalJS: 'force',
          method: 'get',
          onSuccess: function(transport) {
            Element.setStyle($(which + '_star_cur'), 
                             { background: "url('images/stars.png') left 50px"});

            $(which + '_txt').update('Thanks!');

            setTimeout("star.updateNew('"+which+"')", 1000);

        }      
    });
  }
  
  
};

