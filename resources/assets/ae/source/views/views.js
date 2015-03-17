/**
	For simple applications, you might define all of your views in this file.  
	For more complex applications, you might choose to separate these kind definitions 
	into multiple files under this folder.
*/

enyo.kind({
	name: "myapp.MainView",
	kind: "FittableRows",
	fit: true,
	components:[
		{kind: "onyx.Toolbar",classes:"onyx-light", components: [
			// {content: "Examenes"},
			{kind: "mochi.Button", content: "Exámenes", ontap: "helloWorldTap", name:"boton1", onmouseover:"over", onmouseout:"out", attributes: {href:"http://localhost:8888/larapro/public/home",onclick:"window.location = 'http://localhost:8888/larapro/public/home'", target:"_new"}},
		]},
		{kind: "enyo.Scroller", fit: true,classes:"nice-padding" ,components: [
			{name: "main", classes: "nice-padding", allowHtml: true},
			{kind: "Formulario"}

		]},
		{kind: "onyx.Toolbar", layoutKind: "FittableColumnsLayout",components:[
				{content: "Trabajo de AE", classes:"quote"}
		]},
	],
	create: function () {
			this.inherited(arguments);
	},
	helloWorldTap: function(inSender, inEvent) {
		this.$.main.addContent("The button was tapped.<br/>");
	},
	over: function(inSender, inEvent){
		// console.log(inSender);
		inSender.addClass("active");
		// this.$.boton1.active=true;
	},
	out: function(inSender, inEvent){
		inSender.removeClass("active");
	}
});

enyo.kind({
	name: "ButtoMochi",
	classes: "mochi mochi-sample enyo-fit",
	kind: "FittableRows",
	components: [
		{kind: "enyo.Scroller", fit: true, components:[
			{kind: "mochi.Subheader", content: "Buttons"},
			{classes: "mochi-sample-tools", components: [
				{kind: "mochi.Button", content: "Button", ontap:"buttonTapped"},
				{kind: "mochi.Button", content: "Disabled Button", disabled: true, ontap:"buttonTapped"},
				{kind: "mochi.Button", content: "Active Button", classes: "active", ontap:"buttonTapped"},
				{kind: "mochi.Button", content: "Active Disabled Button", classes: "active", disabled: true, ontap:"buttonTapped"},
				{kind: "mochi.Button", content: "Warning Button", classes: "mochi-button-warning", ontap:"buttonTapped"},
				{kind: "mochi.Button", content: "Active Warning Button", classes: "mochi-button-warning", active: true, ontap:"buttonTapped"}
			]},
			{tag: "br"},
			{tag: "br"},
			{kind: "mochi.Subheader", content: "Custom Buttons"},
			{classes: "mochi-sample-tools", components: [
				{kind: "mochi.Button", content: "Custom Bar Color", barClasses: "mochi-sample-orange", ontap:"buttonTapped"},
				{kind: "mochi.Button", content: "Custom End-Caps", decoratorLeft: "<", decoratorRight: ">", ontap:"buttonTapped"}
			]},
			{tag: "br"},
			//replace this with the groupbox below once it's available
			{classes: "mochi-sample-tools mochi-sample-textarea-tools", components: [			
				{name:"result", classes:"mochi-sample-content", content:"No button pressed yet."}
			]}
			/*	
			{kind: "mochi.Groupbox", classes:"mochi-sample-result-box", components: [
				{kind: "mochi.GroupboxHeader", content: "Result"},
				{name:"result", classes:"mochi-sample-result", content:"No button tapped yet."}
			]}
			*/
		]}
	],
	buttonTapped: function(inSender, inEvent) {
		if (inSender.content){
			this.$.result.setContent("The \"" + inSender.getContent() + "\" button was tapped");			
		} else {
			this.$.result.setContent("The \"" + inSender.getName() + "\" button was tapped");						
		}
	}
});
