const { registerBlockType } = window.wp.blocks
const { PlainText } = window.wp.blockEditor

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
 
    edit: ({ attributes: { title, iconClass }, setAttributes }) => 
        <div>
            {iconClass && <i class={iconClass}></i>}
            <PlainText
                value={iconClass} 
                placeholder="Icon class..."
                onChange={value => setAttributes({iconClass: value})} 
            />
            <PlainText
                value={title} 
                placeholder="Content..."
                onChange={value => setAttributes({title: value})} 
            />
        </div>
    ,
 
    save: ({ attributes: { title, iconClass }}) => 
        <li>
            <i aria-hidden="true" class={iconClass}></i>
            <p>{title}</p>
        </li>
    ,
})