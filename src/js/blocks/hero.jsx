const { registerBlockType } = window.wp.blocks
const { PlainText, MediaUpload, RichText } = window.wp.blockEditor
const { Button } = window.wp.components

registerBlockType( "lbh/hero", {
    title: "Hero",
    icon: "star-filled",
    category: "common",
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "h2"
        },
        content: {
            type: "string",
            source: "html",
            selector: "section div"
        },
        background: {
            attribute: "style",
            selector: "section"
        }
    },
 
    edit: ({ attributes: { title, content, background }, setAttributes }) => 
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
            <img src={background}/>
            <MediaUpload
                allowedTypes={["image"]}
                value={background}
                onSelect={media => setAttributes({background: media.url})}
                render={({ open }) =>
                    <Button onClick={open}>Open</Button>
                }
            />
        </div>
    ,
 
    save: ({ attributes: { title, content, background }}) => 
            <section style={`background-image: url('${background}');`}>
                <h1>{title}</h1>
                <RichText.Content tagName="div" value={content}/>
            </section>
    ,
})