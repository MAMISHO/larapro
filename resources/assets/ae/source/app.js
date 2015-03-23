/**
	Define and instantiate your enyo.Application kind in this file.  Note,
	application rendering should be deferred until DOM is ready by wrapping
	it in a call to enyo.ready().
*/

enyo.kind({
	name: "myapp.Application",
	kind: "enyo.Application",
	view: "myapp.MainView"
});

enyo.kind({
	name: "myapp.Application2",
	kind: "enyo.Application",
	view: "ButtoMochi"
});
enyo.kind({
	name: "myapp.Application1",
	kind: "enyo.Application",
	view: "Header"
});
// enyo.ready(function () {
// 	new myapp.Application({name: "app"});
// });
