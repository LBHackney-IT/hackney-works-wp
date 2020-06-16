const { registerBlockType } = window.wp.blocks
const { PlainText, URLInput, RichText } = window.wp.blockEditor

registerBlockType( "lbh/service-teaser", {
    title: "Service teaser",
    icon: "info",
    category: "hackney",
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
            selector: "div p"
        },
        url: {
            type: "string",
            source: "attribute",
            attribute: "href",
            selector: "a"
        }
    },
 
    edit: ({ attributes: { title, content, callToAction, url }, setAttributes, className }) => 
        <div className={className}>
            <RichText
                value={title} 
                tagName="h2"
                allowedFormats={[]}
                placeholder="Headline..."
                onChange={value => setAttributes({title: value})} 
            />
            <RichText 
                value={content} 
                placeholder="Content..."
                onChange={value => 
                    setAttributes({content: value})
                }
            />
            <div className="call-to-action-area">
                <PlainText
                    value={callToAction} 
                    placeholder="Call to action message..."
                    onChange={value => setAttributes({callToAction: value})}
                />
                <URLInput 
                    value={url} 
                    onChange={value => setAttributes({url: value})}
                />
            </div>
        </div>
    ,
 
    save: ({ attributes: { title, content, callToAction, url }, className }) => 
        <div className={`column is-one-third`}>
            <h2>{title}</h2>
            <RichText.Content tagName="p" value={content}/>
            <a class="button" href={url}>{callToAction}</a>
        </div>
    ,
})