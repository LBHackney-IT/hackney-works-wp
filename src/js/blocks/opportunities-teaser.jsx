const { registerBlockType } = window.wp.blocks
const { PlainText, RichText } = window.wp.blockEditor

const icon =
    <svg width="211" height="104" viewBox="0 0 211 104" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="117" width="94" height="30" rx="8" fill="#212121"/>
        <rect x="117" y="52" width="94" height="20" rx="8" fill="#212121"/>
        <rect x="117" y="84" width="49" height="20" rx="8" fill="#212121"/>
        <rect width="94" height="30" rx="8" fill="#212121"/>
        <rect y="52" width="94" height="20" rx="8" fill="#212121"/>
        <rect y="84" width="49" height="20" rx="8" fill="#212121"/>
    </svg>

registerBlockType( "lbh/opportunities-teaser", {
    title: "Opportunities teaser",
    icon: icon,
    category: "hackney",
    attributes: {
        title: {
            type: "string"
        },
        content: {
            type: "string",
            multiline: "p"
        }
    },
 
    edit: ({ attributes: { title, content }, setAttributes }) => 
        <div>
            <PlainText
                value={title} 
                placeholder="Headline..."
                onChange={value => setAttributes({title: value})} 
            />
            <RichText 
                value={content} 
                placeholder="Introduction..."
                onChange={value => 
                    setAttributes({content: value})
                }
            />
        </div>
    ,
 
    save: () => null
})