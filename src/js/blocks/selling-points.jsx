const { registerBlockType } = window.wp.blocks
const { PlainText, InnerBlocks } = window.wp.blockEditor

registerBlockType( 'lbh/selling-points', {
    title: "Selling points",
    icon: "list-view",
    category: "common",
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "h2"
        },
    },

    edit: ({attributes: {title}}) => 
        <div>
            <PlainText
                value={title}
                onChange={value => setAttributes({title: value})} 
            />
            <InnerBlocks allowedBlocks={['lbh/selling-point']} />
        </div>
    ,

    save: ({attributes: {title}}) => 
        <div>
            <h2>{title}</h2>
            <InnerBlocks.Content />
        </div>
    ,
})