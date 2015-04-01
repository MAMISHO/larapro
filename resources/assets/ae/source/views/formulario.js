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
		// console.log("Customizer -> doEditar");
		this.$.form.doCargaDatos(obj);
	}

});

enyo.kind({
	name: "onyx.Formulario",
	kind: "FittableRows", 
	classes: "enyo-fit enyo-unselectable padding15px formBg",
	fit:true,
	components: [

	// {tag:"form", attributes:{action:"http://localhost/larapro/public/home", method:"post"}, components:[
	
	{tag:"form", attributes:{action:"http://localhost/larapro/public/auth/login", method:"POST"}, components:[
		{tag:"div", classes:"panel-head", content:"Iniciar sesión", style:"text-align:center;"},
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
						id:"usuario",			
						name:"usuario"
					}
				},
				{tag:"input",name:"oculto", attributes:{type:"hidden",name:"_token", value:"{{ csrf_token() }}"}},
				{tag:"input",name:"tipo_login", attributes:{type:"hidden",name:"_tipo_login", value:"1"}},
				{tag:"input",name:"position", attributes:{type:"hidden",name:"_position", value:"000"}}
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
						id:"clave",	
						name:"clave"			
					}
				}
			] 	
		},
		{ style:"height:10px" },
		{ style:"height:10px" },
		{
			name:"pickerMemberType",
			onSelect: "itemSelected",
			kind: "onyx.PickerDecorator",
			// attributes:{name:"tipo_login", value:"1"},
			components: [
				{
					kind: "onyx.PickerButton", 
					content: "Tipo de Login", 
					style: "width: 100%"
				},
				{
					kind: "onyx.Picker",
					// attributes:{name:"tipo_login"},
					components: [
						{content: "Clave concertada", active: true, value: 1},
						{content: "Matriz", value: 2},
						{content: "Certificado Digital", value: 3}
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
		]}
		
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


		// var pos = document.querySelector('input[name="position"]').value;
  //       this.$.password.setPlaceholder("Posición de la matriz " + pos);
	},
	taping: function(inSender, inEvent){
		// var token = document.querySelector('input[name="token"]').value;
		// this.$.oculto.setAttr("value:"+token);
		// console.log(this.$.oculto.getAttr("value"));
		// alert(this.$.oculto.getAttr("value"));
		// console.log(this.obj);
		//window.location = 'http://localhost/larapro/public/home?user'+this.$.user.getValue();
		// this.obj.$.titulo.setContent(this.$.titulo.getValue());
		// this.obj.$.contenido.setContent(this.$.contenido.getValue());
		// console.log(this.getAllowHtml());
	},
	doCargaDatos: function(obj){
		this.obj = obj;
		// console.log("CuadroTexto.Custom -> doEditar");
		// console.log(obj);
		this.$.titulo.setValue(obj.$.titulo.getContent());
		this.$.contenido.setValue(obj.$.contenido.getContent());
		// this.render();
	},
	itemSelected: function(inSender, inEvent) {
        // Do something with the selected MenuItem and its content
        // menuItem = inEvent.selected;
        // menuItemContent = inEvent.content;
        // console.log(inEvent.selected);
        // console.log(inEvent.content);
        // console.log(inEvent.selected.value);
        var tipo_login = inEvent.selected.value;
        if(tipo_login === 2){
        	var pos = document.querySelector('input[name="position"]').value;
        	this.$.position.setAttribute("value", pos);
        	this.$.password.setPlaceholder("Posición de la matriz " + pos);
        }
        if(tipo_login === 1){
        	this.$.password.setPlaceholder("Contraseña");
        }

        if(tipo_login === 3){
        	window.location = 'http://localhost/certificado/authViafirma.php?token='+this.$.oculto.getAttribute("value");
        }
        
        // this.$.pickerMemberType.setAttribute("value",tipo_login);
        this.$.tipo_login.setAttribute("value",tipo_login);
    }
});