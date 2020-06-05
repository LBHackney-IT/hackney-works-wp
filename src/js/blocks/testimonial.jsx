const { registerBlockType } = window.wp.blocks
const { PlainText, MediaUpload } = window.wp.blockEditor
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
            selector: "q"
        },
        citation: {
            type: "string",
            source: "text",
            selector: "cite"
        },
        image: {
            attribute: "src",
            selector: "img"
        }
    },
 
    edit: ({ attributes: { message, citation, image }, setAttributes }) => 
        <div>
            {image && <img src={image.url}/>}
            <MediaUpload
                allowedTypes={["image"]}
                value={image}
                onSelect={media => {
                    console.log(media)
                    setAttributes({image: media})
                }}
                render={({ open }) =>
                    <Button onClick={open}>Open</Button>
                }
            />

            <PlainText
                value={message} 
                placeholder="Message..."
                onChange={value => setAttributes({message: value})} 
            />
            <PlainText
                value={citation} 
                placeholder="Citation..."
                onChange={value => setAttributes({citation: value})} 
            />

        </div>
    ,
 
    save: ({ attributes: { message, citation, image }}) => 
        <li>
            <img src={image.url} alt={image.alt}/>
            <blockquote>
                <q>{message}</q>
                <cite>{citation}</cite>
            </blockquote>
        </li>
    ,
})