/**
 * KeyGenerator
 * @type {Class}
 */
var KeyGenerator = new Class(
{
	setKey: function(el)
	{
		var objRequest = new Request.Contao(
		{
			onSuccess: function(key, json)
			{
				el.set('value',key);
				el.highlight('#8AB858');
			}
		}).post({'action':'generateKey', 'name':el.name, 'minlength':el.get('minlength'), 'maxlength':el.get('maxlength'), 'REQUEST_TOKEN':REQUEST_TOKEN});
	}
});

window.addEvent("domready", function() {
	var keyGenerator = new KeyGenerator();
	$$("IMG.keygenerator").addEvent("click",function(e)
    {
		keyGenerator.setKey(e.target.getParent().getElement("input"));
	});
});
