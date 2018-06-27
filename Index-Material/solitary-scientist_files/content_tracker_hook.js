(function() {

  var insert_script_tag = function insert_script_tag(script_src) {
    var new_script = document.createElement('script');
    new_script.async = true;
    new_script.src = script_src;

    var first_script = document.getElementsByTagName('script')[0];
    first_script.parentNode.insertBefore(new_script, first_script);
  };

  var insert_counter_tag = function insert_counter_tag(script_path) {
    query_string = 'from=' + encodeURIComponent(document.location.host) + '&referrer=' + encodeURIComponent(document.referrer)
    if (script_path.indexOf('?') >= 0) {
      url = script_path + '&' + query_string
    } else {
      url = script_path + '?' + query_string
    }
    insert_script_tag(url);
  };

  var script_path_for = function script_path_for(script_attribute) {
    return document.getElementById('theconversation_tracker_hook').getAttribute(script_attribute);
  };

  insert_counter_tag(script_path_for('data-counter') ||
    // Pieces republished before 'data-counter' was added need a workaround.
    script_path_for('data-tracker').replace(/^\/\/(.*)\/tracker$/, 'https://counter.$1/count')
  );
})();
