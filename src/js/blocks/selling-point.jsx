const { registerBlockType } = window.wp.blocks
const { PlainText } = window.wp.blockEditor

registerBlockType( "lbh/selling-point", {
    title: "Selling point",
    icon: "info",
    category: "common",
    parent: [ "lbh/selling-points" ],
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "p"
        }
    },
 
    edit: ({ attributes: { title }, setAttributes }) => 
        <div>
            <PlainText
                value={title} 
                onChange={value => setAttributes({title: value})} 
            />
        </div>
    ,
 
    save: ({ attributes: { title }}) => 
        <div>
            <p>{title}</p>
        </div>
    ,
})