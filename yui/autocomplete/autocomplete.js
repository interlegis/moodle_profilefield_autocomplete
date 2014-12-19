YUI.add('moodle-profilefield_autocomplete-autocomplete', function(Y) {
	  M.profilefield_autocomplete = M.profilefield_autocomplete || {};
	  M.profilefield_autocomplete.autocomplete = {
	    init: function(inputname, datasource) {
	    	var field = Y.one('[name='+inputname+']');
	    	field.plug(Y.Plugin.AutoComplete, {
	    	    resultHighlighter: 'subWordMatch',
	    	    source: datasource
	    	  });
	    }
	  }
}, '@VERSION@', {
	requires: ['node', 'autocomplete', 'autocomplete-highlighters']
});