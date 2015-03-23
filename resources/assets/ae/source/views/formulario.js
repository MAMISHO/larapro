enyo.kind({
	kind: "Control",
	name: "Formulario",
	// style:"width: 100%; height:auto;",
	fit:true,
	components:[
		// {content: "titulo"},
		// {content: "texto"},
		// {tag:"div", classes:"panel-head", content:"Iniciar sesión", style:"text-align:center;"},
		{kind: "onyx.Formulario", name:"form",classes:"formulario"}
	],
	create:function(inSender, inEvent){
		this.inherited(arguments);
		// this.render();
	},
	doEditar:function(obj){
		console.log("Customizer -> doEditar");
		this.$.form.doCargaDatos(obj);
	}

});

enyo.kind({
	name: "onyx.Formulario",
	kind: "FittableRows", 
	classes: "enyo-fit enyo-unselectable padding15px formBg",
	fit:true,
	components: [
<<<<<<< Updated upstream
	{tag:"form", attributes:{action:"http://localhost/larapro/public/home", method:"post"}, components:[
=======
	
	{tag:"form", attributes:{action:"http://localhost/larapro/public/auth/login", method:"POST"}, components:[
		{tag:"div", classes:"panel-head", content:"Iniciar sesión", style:"text-align:center;"},
>>>>>>> Stashed changes
		{tag:"div", style:"text-align: center; color: black;",components:[
			{kind: "fa.Icon", name:"usuarioIcon", icon: "fa-user", size: 5}
		]},
		{tag: "p",name:"errores", content:"", classes:"errores"},
		// { style:"height:20px" },
		{   
			kind: "onyx.InputDecorator",
			classes:"inputStyler", 
			components: [
				{
					name:"user", 
					kind: "onyx.Input", 
					placeholder: "Usuario",
					type:"text",
					focus:true,
					attributes:{
						maxlength:80,
						required:"required",
<<<<<<< Updated upstream
						id:"usuario"				
=======
						name:"usuario"
>>>>>>> Stashed changes
					}
				},
				{tag:"input",name:"oculto", attributes:{type:"hidden",name:"_token", value:"{{ csrf_token() }}"}}
			] 	
		},
		{ style:"height:20px" },
		{   
			kind: "onyx.InputDecorator",
			classes:"inputStyler", 
			components: [
				{
					name:"password", 
					kind: "onyx.Input", 
					placeholder: "Contraseña",
					type:"password",
					attributes:{
						maxlength:80,
						required:"required",
<<<<<<< Updated upstream
						id:"clave"		
=======
						name:"clave"			
>>>>>>> Stashed changes
					}
				}
			] 	
		},
		{ style:"height:10px" },
		{ style:"height:10px" },
		{
			name:"pickerMemberType",
			kind: "onyx.PickerDecorator", 
			components: [
				{
					kind: "onyx.PickerButton", 
					content: "Tipo de Login", 
					style: "width: 100%"
				},
				{
					kind: "onyx.Picker", 
					components: [
						{content: "Tipo 1"},
						{content: "Tipo 2"},
						{content: "Tipo 3"}
					]
				}
			]
		},
		{ style:"height:10px" },
		// Lastly this is textarea. Which is also comes with it's decorator. Unlike normal
		// textarea, enyo has maxlength controls on it too :)
		// {   
		// 	kind: "onyx.InputDecorator",
		// 	classes:"inputStyler", 
		// 	components:[
		// 		{
		// 			kind:"onyx.TextArea",
		// 			name:"contenido",
		// 			style:'width:100%',
		// 			placeholder:"Contenido",
		// 			attributes:{
		// 				maxlength:300,
		// 				required:"required"				
		// 			} 
		// 		}
		// 	] 
		// },

		{ style:"height:10px" },
		{kind:"onyx.Button", name:"actualizar", classes:"onyx-blue", content:"Ingresar", ontap: "taping", style:"color:white;", attributes:{type:"submit"}}
		// {kind: "onyx.Toolbar",
		// classes:"onyx-blue",
		// layoutKind: "FittableColumnsLayout",
		// style:"text-align:center;",
		// components: [
		// 		{kind:"onyx.Button", name:"actualizar", classes:"onyx-blue", content:"Ingresar", ontap: "tap"},
		// 		// {kind:"onyx.Button", name:"cancelar", classes:"onyx-blue", content:"recordar contraseña"}  		
		]},
		
	],
	obj:[],
	create: function(inSender,inEvent){
		this.inherited(arguments);
		// console.log(document.querySelector('input[name="token"]').value);
		var token = document.querySelector('input[name="token"]').value;
		var errores = document.querySelector("#errores");
		if(errores){
			this.$.errores.setContent(document.querySelector("#errores > li").innerHTML);
			// console.log(document.querySelector("#errores > li").innerHTML);
		}
		// console.log(errores);
		this.$.oculto.setAttribute("value",token);
	},
	taping: function(inSender, inEvent){
		// var token = document.querySelector('input[name="token"]').value;
		// this.$.oculto.setAttr("value:"+token);
		// console.log(this.$.oculto.getAttr("value"));
		// alert(this.$.oculto.getAttr("value"));
		// console.log(this.obj);
<<<<<<< Updated upstream
		window.location = 'http://localhost/larapro/public/home?usuario='+this.$.user.getValue();
=======
		//window.location = 'http://localhost/larapro/public/home?user'+this.$.user.getValue();
>>>>>>> Stashed changes
		// this.obj.$.titulo.setContent(this.$.titulo.getValue());
		// this.obj.$.contenido.setContent(this.$.contenido.getValue());
		// console.log(this.getAllowHtml());
	},
	doCargaDatos: function(obj){
		this.obj = obj;
		console.log("CuadroTexto.Custom -> doEditar");
		console.log(obj);
		this.$.titulo.setValue(obj.$.titulo.getContent());
		this.$.contenido.setValue(obj.$.contenido.getContent());
		// this.render();
	}
});