const { registerBlockType } = window.wp.blocks
const { RichText, PlainText, MediaUpload } = window.wp.blockEditor
const { Button } = window.wp.components

registerBlockType( "lbh/testimonial", {
    title: "Testimonial slide",
    icon: "admin-comments",
    category: "hackney",
    parent: [ "lbh/testimonials" ],
    attributes: {
        message: {
            type: "string",
            source: "text",
            selector: "p"
        },
        citation: {
            type: "string",
            source: "text",
            selector: "span"
        },
        imageId: {
            type: 'number'
        },
        imageUrl: {
            type: 'string',
            source: 'attribute',
            selector: 'img',
            attribute: 'src'
        },
        imageAlt: {
            type: 'string',
            source: 'attribute',
            selector: 'img',
            attribute: 'alt'
        }
    },
 
    edit: ({ attributes: { message, citation, imageId, imageUrl, imageAlt }, setAttributes, className }) => 
        <div className={className}>
            <div className="image-area">
                {imageUrl && <img src={imageUrl} aria-hidden="true" alt=""/>}
                <MediaUpload
                    allowedTypes={["image"]}
                    value={imageId}
                    onSelect={media => {
                        console.log(media)
                        setAttributes({
                            imageId: media.id,
                            imageUrl: media.url,
                            imageAlt: media.alt
                        })
                    }}
                    render={({ open }) =>
                        <Button onClick={open}>Choose image...</Button>
                    }
                />
            </div>
            <div className="quote-area">
                <RichText
                    value={message} 
                    allowedFormats={[]}
                    placeholder="Message..."
                    onChange={value => setAttributes({message: value})} 
                />
                <RichText
                    value={citation} 
                    allowedFormats={[]}
                    placeholder="Citation..."
                    onChange={value => setAttributes({citation: value})} 
                />
            </div>
        </div>
    ,
 
    save: ({ attributes: { message, citation, imageAlt, imageUrl }}) => 
        <div className="testimonial clickable">
            <div class="image">
                <img src={imageUrl} alt={imageAlt}/>
            </div>
            <div class="quote">
                <p>{message}</p>
                <span>{citation}</span>
            </div>
        </div>
    ,
})