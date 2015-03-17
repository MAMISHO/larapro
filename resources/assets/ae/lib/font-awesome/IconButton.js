enyo.kind({
    name: "fa.IconButton",
    kind: "onyx.Button",
    published: {
        label: "",
        icon: "",
        spin: false,
        size: 0,
        fixedWidth: false,
        border: false,
        pull: false,
        rotation: "normal"
    },
    components: [
        {
            name: "icon",
            style: "padding: 3px",
            kind: "fa.Icon",
            icon: this.icon,
            spin: this.spin,
            size: this.size,
            fixedWidth: this.fixedWidth,
            border: this.border,
            pull: this.pull,
            rotation: this.rotation
        },
        {name: "label", content: this.label}
    ],
    create: function() {
        this.inherited(arguments);

        this.iconChanged();
        this.labelChanged();
        this.spinChanged();
        this.borderChanged();
        this.fixedWidthChanged();
        this.pullChanged();
        this.sizeChanged();
        this.rotationChanged();
    },
    spinChanged: function() {
        this.$.icon.setSpin(this.spin);
    },
    sizeChanged: function() {
        this.$.icon.setSize(this.size);
    },
    fixedWidthChanged: function() {
        this.$.icon.setFixedWidth(this.fixedWidth);
    },
    borderChanged: function() {
        this.$.icon.setBorder(this.border);
    },
    rotationChanged: function() {
        this.$.icon.setRotation(this.rotation);
    },
    pullChanged: function() {
        this.$.icon.setPull(this.pull);
    },
    iconChanged: function() {
        this.$.icon.setIcon(this.icon);
    },
    labelChanged: function() {
        this.$.label.setContent(this.label);
    }
});