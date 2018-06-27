var syncAjax  = [];
var asyncAjax = [];
var nextSync  = 0;

window.onload = function() {
  popperUpdate();
  if (syncAjax.length > 0) {
    nextSync = 1;
    syncAjax[0]();
  }

  var i;
  for (i=0;i<asyncAjax.length;i++) {
    asyncAjax[i]();
  }
};

var tmpCallerId;
var tmpOnSubmit;

function fillSubCatsOrig(comboId, allCatsList, catId) {
  fillSubCats(comboId, allCatsList, catId).defer();
}

function fillSubCats(comboId, allCatsList, catId) {
  allCats = allCatsList[catId];
  newHtml = "";
  var i = 0;
  for (c in allCats) {
    newHtml += '<OPTION ';
    if (i == 0) newHtml += 'SELECTED="selected"';
    newHtml += 'value= "' + c + '">' + allCats[c] + '</OPTION>';
    i++;
  }
  $(comboId).update(newHtml);
}

function showSubmitWaiting(loadingDiv, text, callerId) {
  window.tmpOnSubmit = $(callerId).onsubmit;
  window.tmpCallerId = callerId;
  $(callerId).onsubmit = function(event) { return true; };
  $("popupButtons").style.display = "none";
  $("popupTextBox").focus();
  showOKPopup($(loadingDiv).innerHTML +
              '<P ALIGN="CENTER">' + text + '</P>',
              'Submission');
}

function showGradingPerformed(loadingDiv, text, hash, whereto) {

  destonation = whereto || 'submit_ajax.php';

  $("popupTextBox").update($(loadingDiv).innerHTML +
                           '<P ALIGN="CENTER">' + text + '</P>');
  new Ajax.Request(destonation+'?wait_grade='+hash, {
      evalJS: 'force',
        method: 'get',
        onSuccess: function(transport) {
          $("popupTextBox").update(transport.responseText);
          $("popupButtons").show();
          $("popupClose").focus();
          $(window.tmpCallerId).onsubmit = window.tmpOnSubmit;
        },
        onFailure: function(request) {
          $("popupTextBox").update('Request Error!');
          $("popupClose").focus();
          $(window.tmpCallerId).onsubmit = window.tmpOnSubmit;
        }
  });

}

function showUploadError(htmlText) {
  $("popupTextBox").update(htmlText);
  $("popupButtons").show();
  $("popupClose").focus();
  $(window.tmpCallerId).onsubmit = window.tmpOnSubmit;
}

function ajaxReplace(element, urlink, loadingDiv) {
  if (loadingDiv) {
    $(element).update($(loadingDiv).innerHTML);
  }
  doAJAX(urlink, element);
};

function dropDownByAJAX(src, dest, loadingDiv, skipit) {
  page = [src, dest];

  if ($(dest).innerHTML != "") {
    $(dest).update("");
  } else {
    $(dest).update($(loadingDiv).innerHTML);
    doAJAX(src, dest);
  }
};

function fillOutByAJAX(src, dest, loadingDiv, outer) {
  $(dest).update($(loadingDiv).innerHTML);
  new Ajax.Request(src, {
      evalJS: 'force',
        method: 'get',
        onSuccess: function(transport) {
        if (outer) {
          $(dest).parentNode.update(transport.responseText);
        } else {
          $(dest).update(transport.responseText);
        }
      }
  });
};

function doRegrade(sid)
{
    new Ajax.Request("regrade_ajax.php?submission_id=" + sid, {
	    evalJS: 'force',
		method: 'get',
                onSuccess: function(transport) {
		showOKPopup('<b>Result:</b></br><pre>' + transport.responseText + '</pre>');
		//window.location.reload();
	    },
        onFailure: function(request) {
        showOKPopup('<b>Error:</b> ' + src);
      }
  });
};

function doAJAX(src, dest, cbFunction) {
  new Ajax.Request(src, {
      evalJS: 'force',
        method: 'get',
        onSuccess: function(transport) {
          if (cbFunction) {
            cbFunction(transport.headerJSON, transport.responseText);
          } else {
            $(dest).update(transport.responseText);
          }
      },
        onFailure: function(request) {
        showOKPopup('<b>Error getting:</b> ' + src);
      }
  });
};

function focusMe(name) {
  $(name).focus();
};

function doAJAXSync(src, dest) {
  new Ajax.Request(src, {
      evalJS: 'force',
        method: 'get',
        onSuccess: function(transport) {
        $(dest).update(transport.responseText);
        if (nextSync < syncAjax.length) {
          nextSync++;
          syncAjax[nextSync-1]();
        }
      }
  });
};

function onloadRegisterSync(func) {
  syncAjax.push(func);
};

function onloadRegisterAsync(func) {
  asyncAjax.push(func);
};

function onloadRegister(func, sync) {
  if (sync) {
    onloadRegisterSync(func);
  } else {
    onloadRegisterAsync(func);
  }
};

function fetchTo(element, dest) {
  doAJAX(element.href, dest);
  return false;
}

function showOKPopup(text, boxTitle) {
  if (boxTitle)
    $("popupBoxHeader").update(boxTitle);
  else
    $("popupBoxHeader").update('...');
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupBoxContainer").style.zIndex = 100;
  $("popupTextBox").update(text);
  $("popupBox").style.visibility = "visible";
}

function showDDBox(text) {
  $("ddBoxContainer").style.zIndex = 100;
  if ($("ddBoxContainer").visible()) {
    (function () {
      new Effect.SlideUp("ddBoxContainer", { duration: 0.4, queue: 'end' ,
            afterFinish: function(e) {
            $("ddBoxContainer").visibility = "hidden";
            $("ddTextBox").update(text);
            $("ddBoxContainer").visibility = "visible";
            new Effect.SlideDown('ddBoxContainer', {
                duration: 0.5, queue: 'end'});
          }});
    }).defer();
  } else {
    $("ddBoxContainer").visibility = "hidden";
    $("ddTextBox").update(text);
    $("ddBoxContainer").visibility = "visible";
    new Effect.SlideDown('ddBoxContainer', {
        duration: 0.4, queue: 'end'});
  }
}

function closeDDPopup() {
  new Effect.SlideUp("ddBoxContainer", { duration: 0.4, queue: 'end' ,
        afterFinish: function(e) {
        $("ddBoxContainer").visibility = "hidden";
        $("ddTextBox").update('');
      }});
}

function openPopup(name) {
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupBoxContainer").style.zIndex = 100;
  $("popupTextBox").innerHTML = $(name).innerHTML;
  $("popupBox").style.visibility = "visible";
  focusFirstInput($("popupBox"));
};

function openPopupYesNo(title, test, target) {
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupBoxHeaderYesNo").innerHTML = title;
  $("popupYesNoContainer").style.zIndex = 100;
  $("popupYesNoText").innerHTML = test;
  $("popupYesNoYes").onclick = function (z) { document.location.href = target;};
  $("popupYesNo").style.visibility = "visible";
  focusFirstInput($("popupYesNoNo"));
  return true;
};

function closeYesNoPopup() {
  $("popupBlocker").style.visibility = 'hidden';
  $("popupYesNo").style.visibility = "hidden";
  $("popupYesNoText").update('');
  $("popupYesNoContainer").style.zIndex = -1;
};


function openPopupForm(name) {
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupFormContainer").style.zIndex = 100;
  $("popupFormText").innerHTML = $(name).innerHTML;
  $("popupForm").style.visibility = "visible";
  focusFirstInput($("popupFormText"));
};

function openPopupFormCustom(name, whatelem, whatvalue) {
  $(whatelem).value = whatvalue;
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupFormContainer").style.zIndex = 100;
  $("popupFormText").innerHTML = $(name).innerHTML;
  $("popupForm").style.visibility = "visible";
  focusFirstInput($("popupFormText"));
};

function openPopupFetchedOK(sourceUrl) {
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupBoxContainer").style.zIndex = 100;

  $("popupTextBox").update($('genericLoadingCode').innerHTML);
  $("popupBox").style.visibility = "visible";

  new Ajax.Request(sourceUrl, {
      evalJS: 'force',
        method: 'get',
        onSuccess: function(transport) {

        $("popupTextBox").update(transport.responseText);
        focusFirstInput($("popupBox"));

      }
  });

}

function openPopupFetchedForm(sourceUrl) {
  popBlocker = $("popupBlocker");
  popBlocker.style.width = "100%";
  popBlocker.style.height = "100%";
  popBlocker.style.visibility = "visible";
  $("popupFormContainer").style.zIndex = 100;

  new Ajax.Request(sourceUrl, {
      evalJS: 'force',
        method: 'get',
        onSuccess: function(transport) {

        $("popupFormText").update(transport.responseText);
        $("popupForm").style.visibility = "visible";
        focusFirstInput($("popupFormText"));

      }
  });

};

function closePopup() {
  $("popupBlocker").style.visibility = 'hidden';
  $("popupBox").style.visibility = "hidden";
  $("popupTextBox").update('');
  $("popupBoxContainer").style.zIndex = -1;
};

function closePopupForm() {
  $("popupBlocker").style.visibility = 'hidden';
  $("popupForm").style.visibility = "hidden";
  $("popupFormText").update('');
  $("popupFormContainer").style.zIndex = -1;
};

function focusFirstInput(obj) {
  var found = false;
  var i;
  for (i=0; i<obj.childNodes.length; i++) {
    if (!found) {
      if (obj.childNodes[i].tagName == "INPUT") {
        if (obj.childNodes[i].type == "text") {
          obj.childNodes[i].focus();
          return true;
        }
        if (obj.childNodes[i].type == "password") {
          obj.childNodes[i].focus();
          return true;
        }
        if (obj.childNodes[i].type == "file") {
          obj.childNodes[i].focus();
          return true;
        }
        if (obj.childNodes[i].type == "checkbox") {
          obj.childNodes[i].focus();
          return true;
        }
      }
      if (obj.childNodes[i].tagName == "TEXTAREA") {
        obj.childNodes[i].focus();
        return true;
      }
      if (obj.childNodes[i].tagName == "BUTTON") {
        obj.childNodes[i].focus();
        return true;
      }
      if (obj.childNodes[i].tagName == "SELECT") {
        obj.childNodes[i].focus();
        return true;
      }
      found = focusFirstInput(obj.childNodes[i]);
    }
  }
  return found;
};

function getUrl(obj) {
  var getstr = "";
  var i;
  for (i=0; i<obj.childNodes.length; i++) {
    if (obj.childNodes[i].tagName == "INPUT") {
      if (obj.childNodes[i].type == "text") {
        getstr += obj.childNodes[i].name + "=" + encodeURIComponent(obj.childNodes[i].value) + "&";
      }
      if (obj.childNodes[i].type == "password") {
        getstr += obj.childNodes[i].name + "=" + encodeURIComponent(obj.childNodes[i].value) + "&";
        obj.childNodes[i].value = "";
      }
      if (obj.childNodes[i].type == "hidden") {
        getstr += obj.childNodes[i].name + "=" + encodeURIComponent(obj.childNodes[i].value) + "&";
        obj.childNodes[i].value = "";
      }
      if (obj.childNodes[i].type == "file") {
        getstr += obj.childNodes[i].name + "=@" + encodeURIComponent(obj.childNodes[i].value) + "&";
      }
      if (obj.childNodes[i].type == "checkbox") {
        if (obj.childNodes[i].checked) {
          getstr += obj.childNodes[i].name + "=" + encodeURIComponent(obj.childNodes[i].value) + "&";
        } else {
          getstr += obj.childNodes[i].name + "=0&";
        }
      }
      if (obj.childNodes[i].type == "radio") {
        if (obj.childNodes[i].checked) {
          getstr += obj.childNodes[i].name + "=" + encodeURIComponent(obj.childNodes[i].value) + "&";
        }
      }
    }
    if (obj.childNodes[i].tagName == "TEXTAREA") {
      getstr += obj.childNodes[i].name + "=" + encodeURIComponent(obj.childNodes[i].value) + "&";
    }
    if (obj.childNodes[i].tagName == "SELECT") {
      var sel = obj.childNodes[i];
      getstr += sel.name + "=" + encodeURIComponent(sel.options[sel.selectedIndex].value) + "&";
    }
    getstr += getUrl(obj.childNodes[i]);
  }
  return getstr;
};

function submitAjaxForm(url, formId, dest, loadingDiv, isPopup, outer, cbFunction) {

  var src;

  if (isPopup > 0) {
    src= url + "&" + getUrl($("popupFormText")) + "&date_for_cache=" + new Date();
  } else {
    src= url + "&" + getUrl($(formId)) + "&date_for_cache=" + new Date();
  }

  if (dest) {
    $(dest).update($(loadingDiv).innerHTML);
  }

  new Ajax.Request(src, {
      evalJS: 'force',
        method: 'post',
        onSuccess: function(transport) {
        if (cbFunction) {
          cbFunction(transport.headerJSON, transport.responseText);
        } else {
          if (outer) {
            $(dest).parentNode.update(transport.responseText);
          } else {
            $(dest).update(transport.responseText);
          }
        }
      }
  });

  if (isPopup > 0) {
    closePopupForm();
  }

  return false;
};

function checkEnter(e) {

  var characterCode

    if(e && e.which){
      e = e ;
      characterCode = e.which;
    } else {
      e = event;
      characterCode = e.keyCode ;
    }

  if (characterCode == 13) {
    return true;
  } else {
    return false;
  }
};

InlineComments = {
  didit : function(tJSON, tText) {
    if (!tJSON) return;
    if (tJSON.done == 1) {
      Element.insert($('inlinecomment'+tJSON.line), {bottom: tJSON.rendered});
      new Effect.Appear($(tJSON.adid), {duration: 0.5});
    } else {
      showOKPopup(tJSON.reason);
    }
  },
  undidit : function(tJSON, tText) {
    if (!tJSON) return;
    if (tJSON.done == 1) {
      new Effect.Puff($(tJSON.cmid), {duration: 0.7});
    } else {
      showOKPopup(tJSON.reason);
    }
  }
};



function addCloserListener (contain, cldiv, src, cbFunction) {

  $(contain).insert({top: '<DIV ID="' + cldiv + '" CLASS = "closerButton" ONCLICK = "doAJAX(\''+src+'\', 0, '+cbFunction+');" STYLE="display: none;"> </div>'});

  $(cldiv).isshown = false;
  $(cldiv).showme = function() {
    $(cldiv).show();
  };
  $(cldiv).hideme = function() {
    $(cldiv).hide();
  };

  $(contain).observe('mouseenter',
                     function(e) {
                       $(cldiv).showme();
                     });

  $(contain).observe('mouseleave',
                     function(e) {
                       $(cldiv).hideme();
                     });

  $(cldiv).observe('mouseenter',
                   function(e) {
                     new Effect.Pulsate($(cldiv), {pulses: 1, duration: 0.2, from: 0.3});
                   });


};

function popperUpdate() {
  new Ajax.Request('json_feed.php?getpoppers=1', {
      evalJS: 'force',
      method: 'get',
      onSuccess: function(transport) {
        var rep = transport.headerJSON;
        if (rep['hasNew']) {
          showDDBox($("ddTextBox").innerHTML+"<br>"+rep["poppers"]);
        }
      }
  });
};

setInterval("popperUpdate()", 20000);


window.loadHist = function(page) {
  //new Ajax.Updater('main', page, { method: 'get', evalScripts: true });

  //page2 = decodeURIComponent(dhtmlHistory.getCurrentHash()).evalJSON();
  console.log(page);
  //dropDownByAJAX(page2[0], page2[1], 'genericLoadingCode', true);
  //dhtmlHistory.add(page);
  return false;
};

//Event Observations
//Event.observe(window, 'load', function() { //Initialize RSH
//    dhtmlHistory.initialize();
//    dhtmlHistory.addListener(loadHist); //On history change, call 'loadHist' function
//});

