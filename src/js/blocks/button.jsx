const { registerBlockType } = window.wp.blocks
const { RichText, URLInput } = window.wp.blockEditor

const icon = 
    <svg width="199" height="62" viewBox="0 0 199 62" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="199" height="62" rx="8" fill="#212121"/>
        <rect x="56" y="21" width="90" height="20" rx="8" fill="white"/>
    </svg>

registerBlockType( "lbh/button", {
    title: "Button",
    icon: icon,
    category: "hackney",
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "a"
        },
        url: {
            type: "string",
            source: "attribute",
            attribute: "href",
            selector: "a"
        }
    },
 
    edit: ({ attributes: { title, url }, setAttributes, className }) => 
        <div className={className}>
            <div class="inner">
                <RichText
                    value={title} 
                    allowedFormats={[]}
                    placeholder="Button text..."
                    onChange={value => setAttributes({title: value})} 
                />
            </div>
            <URLInput 
                value={url} 
                onChange={value => setAttributes({url: value})}
            />
        </div>
    ,
 
    save: ({ attributes: { title, url }, className}) => 
        <div className={`button-holder ${className}`}>
            <a className="button is-primary is-large" href={url}>{title}</a>
        </div>
    ,
})