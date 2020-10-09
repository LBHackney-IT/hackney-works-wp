const { registerBlockType } = window.wp.blocks
const { PlainText, RichText } = window.wp.blockEditor

registerBlockType( "lbh/selling-point", {
    title: "Selling point",
    icon: "info",
    category: "hackney",
    parent: [ "lbh/selling-points" ],
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "p"
        },
        iconClass: {
            type: "string",
            attribute: "class",
            selector: "i"
        }
    },
 
    edit: ({ attributes: { title, iconClass }, setAttributes, className }) => 
        <div className={className}>
            <div className="icon-holder">
                {iconClass && <i class={iconClass}></i>}
            </div>
            <PlainText
                value={iconClass} 
                placeholder="Icon class..."
                onChange={value => setAttributes({iconClass: value})} 
            />
            <RichText
                value={title} 
                allowedFormats={[]}
                placeholder="Selling point content..."
                onChange={value => setAttributes({title: value})} 
            />
        </div>
    ,
 
    save: ({ attributes: { title, iconClass }, className}) => 
        <div className={`selling-points__point ${className}`}>
            <div class="selling-points__icon-circle">
                <i aria-hidden="true" class={iconClass}></i>
            </div>
            <p>{title}</p>
        </div>
    ,
})