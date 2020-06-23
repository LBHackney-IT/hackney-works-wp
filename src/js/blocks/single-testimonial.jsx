const { registerBlockType } = window.wp.blocks
const { MediaUpload, RichText } = window.wp.blockEditor
const { Button } = window.wp.components

const icon = 
    <svg width="199" height="114" viewBox="0 0 199 114" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="199" height="114" rx="8" fill="#212121"/>
        <rect x="71" y="61" width="56" height="18" rx="8" fill="white"/>
        <rect x="44" y="34" width="110" height="18" rx="8" fill="white"/>
    </svg>


registerBlockType( "lbh/single-testimonial", {
    title: "Single testimonial",
    icon: icon,
    category: "hackney",
    attributes: {
        message: {
            type: "string"
        },
        citation: {
            type: "string"
        },
        background: {
            type: "string"
        }
    },
 
    edit: ({ attributes: { message, citation, background }, setAttributes, className }) => 
    <div className={className}>
        <img src={background} aria-hidden="true" alt=""/>
        <RichText
            value={message} 
            tagName="h3"
            placeholder="Message..."
            allowedFormats={[]}
            onChange={value => setAttributes({message: value})} 
        />
        <RichText 
            value={citation} 
            placeholder="Citation..."
            onChange={value => 
                setAttributes({citation: value})
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
 
    save: ({ attributes: { message, citation, background }}) => 
        <div className="full-width hero" id="testimonials">
            <div class="bg_img">
                <img class="parralax_me" id="parralax_me2" src={background} alt="" aria-hidden="true"/>
            </div>
            <div class="container">
                <div class="slider">
                <div class="testimonial active">
                        <br/>
                        <br/>
                        <div class="quote">
                            <p>{message}</p>
                            <span>{citation}</span>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>

})