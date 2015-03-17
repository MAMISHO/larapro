enyo.kind({
    name: "fa.Icon",
    tag: "i",
    classes: "fa",
    published: {
        spin: false,
        size: 0,
        fixedWidth: false,
        border: false,
        pull: false,
        rotation: "normal",
        icon: ""
    },
    create: function(){
        this.inherited(arguments);

        this.iconChanged();
        this.spinChanged();
        this.sizeChanged();
        this.fixedWidthChanged();
        this.borderChanged();
        this.pullChanged();
        this.rotationChanged();
    },
    iconChanged: function() {
        this.addClass(this.icon);
    },
    spinChanged: function() {
        this.addRemoveClass("fa-spin", this.spin);
    },
    sizeChanged: function() {
        switch (this.size) {
            case 1:
                this.addClass("fa-lg");
                break;
            case 2:
                this.addClass("fa-2x");
                break;
            case 3:
                this.addClass("fa-3x");
                break
            case 4:
                this.addClass("fa-4x");
                break
            case 5:
                this.addClass("fa-5x");
                break
        }
    },
    fixedWidthChanged: function() {
        this.addRemoveClass("fa-fw", this.fixedWidth);

    },
    borderChanged: function() {
        this.addRemoveClass("fa-border", this.border);

    },
    pullChanged: function() {
        switch(this.pull) {
            case "right":
                this.addClass("pull-right");
                break
            case "left":
                this.addClass("pull-left");
        }
    },
    rotationChanged: function() {
        switch(this.rotation) {
            case 90:
                this.addClass("fa-rotate-90");
                break;
            case 180:
                this.addClass("fa-rotate-180");
                break
            case 270:
                this.addClass("fa-rotate-270");
                break
            case "flip-horizontal":
                this.addClass("fa-flip-horizontal");
                break
            case "flip-vertical":
                this.addClass("fa-flip-vertical");
                break
        }
    }
});