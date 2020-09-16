const { registerBlockType } = window.wp.blocks
const { PlainText, URLInput, RichText, MediaUpload } = window.wp.blockEditor
const { Button } = window.wp.components

registerBlockType( "lbh/tile-solid-button", {
    title: "Tile with solid button",
    icon: "info",
    category: "hackney",
    parent: [ "lbh/tiles" ],
    attributes: {
        imageSrc: {
            type: "string"
        },
        imageAlt: {
            type: "string"
        },
        title: {
            type: "string",
            source: "text",
            selector: "h3"
        },
        content: {
            type: "string",
            source: "html",
            selector: "div p"
        },
        buttonHref: {
            type: "string"
        },
        buttonText: {
            type: "string"
        },
    },
 
    edit: ({ attributes: { title, content, imageSrc, imageAlt, buttonHref, buttonText }, setAttributes, className }) => 
        <div className={className}>
            {imageSrc && <img src={imageSrc} alt={imageAlt}/>}
            <MediaUpload
                allowedTypes={["image"]}
                value={imageSrc}
                onSelect={media => {
                    setAttributes({
                        imageSrc: media.url,
                        imageAlt: media.alt
                    })
                }}
                render={({ open }) =>
                    <Button onClick={open}>Choose image...</Button>
                }
            />
            <RichText
                value={title} 
                tagName="h3"
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
            <div class="button-area">
                <RichText
                    value={buttonText} 
                    tagName="p"
                    allowedFormats={[]}
                    placeholder="Button text..."
                    onChange={value => setAttributes({buttonText: value})} 
                />
            </div>

            <URLInput 
                value={buttonHref} 
                onChange={value => setAttributes({buttonHref: value})}
            />

        </div>
    ,
 
    save: ({ attributes: { title, content, imageSrc, imageAlt, buttonHref, buttonText }, className }) => 
        <div className="tiles__tile">
            <img loading="lazy" src={imageSrc} alt={imageAlt}/>
            <div class="tiles__inner">
                <h3>{title}</h3>
                <RichText.Content tagName="p" value={content}/>
                <a class="tiles__button tiles__button--solid" href={buttonHref}>{buttonText}</a>
            </div>
        </div>
    ,
})