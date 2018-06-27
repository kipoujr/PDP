if (soundManager) {
  soundManager.addOnLoad(function() { soundManager.createSound({
          id: 'msgarr',
            url: 'external/soundmanager2/demo/_mp3/click-high.mp3',
            autoPlay: false,
            autoLoad: true,
            volume: 100 });
    });
};

zchat = {};
zchat.rnd = "";
zchat.reqSent = 0;
zchat.lastUId = 0;
zchat.lastRnd = "123123123";
zchat.ret = {};
zchat.lastMine = false;
zchat.lastMineId = '';

zchat.trySend = function(rnd, userId, chatId, e) {
  if (e.keyCode == Event.KEY_RETURN) {
    pTxt = $("CIN_"+rnd).getValue();
    if (pTxt) {
      $("CIN_"+rnd).clear();
      new Ajax.Request('chat_ajax.php?userId='+userId+'&chatId='+chatId+'&txt='+encodeURIComponent(pTxt), {
          evalJS: 'force',
            method: 'get',
            onSuccess: function(transport) {
            var rep = transport.headerJSON;
            var toAppear = true;
            if (rep['hasUpdate']) {
              if (zchat.lastMine) {
                Element.insert($(zchat.lastMineId), {after: rep['myPL']});
                toAppear = false;
              } else {
                Element.insert($(rnd), {bottom: rep['postData']});
              }
              zchat.lastMineId = rep['myId'];
              if (soundManager)
                soundManager.play('msgarr');
              zchat.fixScroll(rnd, toAppear, 1);
              zchat.lastUId = rep['lastUId'];
              zchat.lastRnd = rep['lastRnd'];
              zchat.lastMine = true;
            }
          }
      });
    }
    return false;
  }
};



zchat.tryIt = function(son) {
  alert(1);
}

  zchat.tryUpdate = function(rnd, userId, chatId) {
    if (zchat.reqSent > 0)
      return;
    zchat.reqSent = 1;
    new Ajax.Request('chat_ajax.php?userId='+userId+'&chatId='+chatId, {
        evalJS: 'force',
          method: 'get',
          onSuccess: function(transport) {
          zchat.reqSent = 0;
          var rep = transport.headerJSON;
          var toAppear = true;
          var needScroll = false;
          if (rep['whosOnline']) {
            if ($('WHOS_ONLINE')) {
              $('WHOS_ONLINE').update(rep['whosOnline']);
            }
          }
          if (rep['lastPid']) {
            Element.insert($(rep['lastPid']), {after: rep['lastUpdate']});
            toAppear = false;
            needScroll = true;
          }
          if (rep['hasUpdate']) {
            Element.insert($(rnd), {bottom: transport.responseText});
            needScroll = true;
            zchat.lastUId = rep['lastUId'];
            zchat.lastRnd = rep['lastRnd'];
          }
          if (needScroll) {
            if (soundManager)
              soundManager.play('msgarr');
            zchat.lastMine = false;
            zchat.fixScroll(rnd, toAppear, 1);
          }
        }
    });
    return false;
  };

zchat.tryFree = function(repp) {
  //  alert(document.title + repp);
  zchat.reqSent = 0;
  //zchat.tryLightUpdate(zchat.rnd, zchat.userId, zchat.chatId).bind(this);
  zchat.rr = repp;
  rep = repp.ok.evalJSON();
  if (rep.myId) {
    var toAppear = true;
    var needScroll = false;
    if (rep['myId'] == zchat.lastUId) {
      Element.insert($('PPID_' + zchat.lastPId), {after: rep['myP']});
      toAppear = false;
      needScroll = true;
      zchat.lastPId = rep.mpId;
      zchat.lastUId = rep.myId;
    } else {
      Element.insert($(zchat.rnd), {bottom: rep['postData']});
      needScroll = true;
      zchat.lastUId = rep.myId;
      zchat.lastPId = rep.mpId;
    }
    if (needScroll) {
      if (soundManager)
        soundManager.play('msgarr');
      zchat.lastMine = false;
      zchat.fixScroll(zchat.rnd, toAppear, 1);
      zchat.tryLightUpdate(zchat.rnd, zchat.userId, zchat.chatId);
    }
  }
};

zchat.doUpdate = function(repp) {
  rep = repp.toJSON();
  zchat.rr = repp;
  if (rep.myId) {
    var toAppear = true;
    var needScroll = false;
    alert(rep.myId == zchat.lastUId);
    if (rep.myId == zchat.lastUId) {
      alert("PPID_".zchat.lastPId);
      alert(rep.myP);
      Element.insert($("PPID_".zchat.lastPId), {after: rep['myP']});
      toAppear = false;
      needScroll = true;
      zchat.lastPId = rep.mpId;
      zchat.lastUId = rep.myId;
    } else {
      Element.insert($(rnd), {bottom: rep['postData']});
      needScroll = true;
      zchat.lastUId = rep.myId;
      zchat.lastPId = rep.mpId;
    }
    if (needScroll) {
      if (soundManager)
        soundManager.play('msgarr');
      zchat.lastMine = false;
      zchat.fixScroll(rnd, toAppear, 1);
      zchat.tryLightUpdate(zchat.rnd, zchat.userId, zchat.chatId);
    }
  }
};

zchat.tryLightUpdate = function(rnd, userId, chatId) {
  if (zchat.reqSent > 0)
    return;
  zchat.reqSent = 1;
  zchat.rnd = rnd;
  zchat.userId = userId;
  zchat.chatId = chatId;
  var e = document.createElement("script");
  e.src = 'http://www.z-trening.com:8000/chat?chatr='+chatId+ "&t=" + new Date().getTime().toString();
  e.type = "text/javascript";
  document.getElementsByTagName("head")[0].appendChild(e);
  //alert('<script src="http://www.z-trening.com:8000/chat?chatr='+chatId+ "&t=" + new Date().getTime().toString()+'" />');
};


Effect.Scroll = Class.create();
Object.extend(Object.extend(Effect.Scroll.prototype, Effect.Base.prototype), {
    initialize: function(element) {
      this.element = $(element);
      if(!this.element) throw(Effect._elementDoesNotExistError);
      this.start(Object.extend({x: 0, y: 0}, arguments[1] || {}));
    },
      setup: function() {
      var scrollOffsets = (this.element == window)
        ? document.viewport.getScrollOffsets()
        : Element._returnOffset(this.element.scrollLeft, this.element.scrollTop) ;
      this.originalScrollLeft = scrollOffsets.left;
      this.originalScrollTop  = scrollOffsets.top;
    },
      update: function(pos) {
      this.element.scrollTo(Math.round(this.options.x * pos + this.originalScrollLeft), Math.round(this.options.y * pos + this.originalScrollTop));
    }
  });

Element.addMethods({
    scrollTo: function(element, left, top){
      var element = $(element);
      if (arguments.length == 1){
        var pos = element.cumulativeOffset();
        window.scrollTo(pos[0], pos[1]);
      } else {
        element.scrollLeft = left;
        element.scrollTop  = top;
      }
      return element;
    }
  });

zchat.fixScroll = function(rnd, toAppear, canskip) {
  $('CIN_'+rnd).focus();
  st = $('PAR_'+rnd).scrollTop;
  delta = Element.getHeight($(rnd)) + Element.getHeight(Element.childElements($(rnd)).last()) - 600 - st;
  if (delta < 0) {
    delta = 0;
  }
  if (!canskip || (delta < 600)) {
    new Effect.Scroll($('PAR_'+rnd), { y: delta, duration: 0.5 });
  }
  if (toAppear)
    Effect.Appear(Element.identify(Element.childElements($(rnd)).last()), {duration: 0.5});
  else
    Effect.Pulsate(Element.identify(Element.childElements($(rnd)).last()), {pulses: 1, duration: 0.5, from: 0.7});

};