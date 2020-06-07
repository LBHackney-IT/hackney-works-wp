const { registerBlockType } = window.wp.blocks
const { MediaUpload, RichText } = window.wp.blockEditor
const { Button } = window.wp.components

const icon = 
    <svg width="199" height="104" viewBox="0 0 199 104" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="199" height="30" rx="8" fill="#212121"/>
        <rect y="52" width="144" height="20" rx="8" fill="#212121"/>
        <rect y="84" width="75" height="20" rx="8" fill="#212121"/>
    </svg>

registerBlockType( "lbh/hero", {
    title: "Hero",
    icon: icon,
    category: "hackney",
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "h1"
        },
        content: {
            type: "string",
            source: "html",
            selector: "section div"
        },
        background: {
            type: "string"
        }
    },
 
    edit: ({ attributes: { title, content, background }, setAttributes, className }) => 
        <div className={className}>
            {console.log(background)}
            <img src={background} aria-hidden="true" alt=""/>
            <RichText
                value={title} 
                tagName="h1"
                placeholder="Headline..."
                allowedFormats={[]}
                onChange={value => setAttributes({title: value})} 
            />
            <RichText 
                value={content} 
                placeholder="Introductory content..."
                onChange={value => 
                    setAttributes({content: value})
                }
            />
            <MediaUpload
                allowedTypes={["image"]}
                value={background}
                onSelect={media => setAttributes({background: media.url})}
                render={({ open }) =>
                    <Button onClick={open}>Choose background image...</Button>
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