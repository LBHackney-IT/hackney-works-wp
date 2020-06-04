const { registerBlockType } = window.wp.blocks
const { PlainText, URLInput, RichText } = window.wp.blockEditor

registerBlockType( "lbh/service-teaser", {
    title: "Service teaser",
    icon: "info",
    category: "common",
    parent: [ "lbh/service-teasers" ],
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "h2"
        },
        callToAction: {
            type: "string",
            source: "text",
            selector: "a"
        },
        content: {
            type: "string",
            source: "html",
            selector: "div div"
        },
        url: {
            type: "string",
            source: "attribute",
            attribute: "href",
            selector: "a"
        }
    },
 
    edit: ({ attributes: { title, content, callToAction, url }, setAttributes }) => 
        <div>
            <PlainText
                value={title} 
                onChange={value => setAttributes({title: value})} 
            />
            <RichText 
                value={content} 
                onChange={value => 
                    setAttributes({content: value})
                }
            />
            <PlainText
                value={callToAction} 
                onChange={value => setAttributes({callToAction: value})}
            />
            <URLInput 
                value={url} 
                onChange={value => setAttributes({url: value})}
            />
        </div>
    ,
 
    save: ({ attributes: { title, content, callToAction, url }}) => 
        <div class="column is-one-third">
            <h2>{title}</h2>
            <RichText.Content tagName="div" value={content}/>
            <a href={url}>{callToAction}</a>
        </div>
    ,
})