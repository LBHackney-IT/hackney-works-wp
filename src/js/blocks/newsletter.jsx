const { registerBlockType } = window.wp.blocks
const { RichText } = window.wp.blockEditor

const icon = 
    <svg width="199" height="114" viewBox="0 0 199 114" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="199" height="114" rx="8" fill="#212121"/>
        <rect x="124" y="39.1875" width="56" height="33.25" rx="8" fill="white"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M106 45.1875H25C23.8954 45.1875 23 46.0829 23 47.1875V64.4375C23 65.5421 23.8954 66.4375 25 66.4375H106C107.105 66.4375 108 65.5421 108 64.4375V47.1875C108 46.0829 107.105 45.1875 106 45.1875ZM25 39.1875C20.5817 39.1875 17 42.7692 17 47.1875V64.4375C17 68.8558 20.5817 72.4375 25 72.4375H106C110.418 72.4375 114 68.8558 114 64.4375V47.1875C114 42.7692 110.418 39.1875 106 39.1875H25Z" fill="white"/>
    </svg>

registerBlockType( 'lbh/newsletter', {
    title: "Newsletter signup",
    icon: icon,
    category: "hackney",
    attributes: {
        title: {
            type: "string",
            source: "text",
            selector: "h2"
        },
        content: {
            type: "string",
            multiline: "p"
        }
    },

    edit: ({ attributes: { title, content }, className, setAttributes }) => 
        <div className={className}>
            <RichText
                value={title} 
                tagName="h2"
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
            <p><em><small>Sign-up form here</small></em></p>
        </div>
    ,

    save: ({ attributes: { title, content } }) => 
        <div className="container" id="newsletter">
            <br/>
            <br/>
            <h2>{title}</h2>
            <p class="about">{content}</p>
            <form 
                method="get" 
                action="https://public.govdelivery.com/accounts/UKHACKNEYCOUNCIL/subscriber/qualify"  
                target="_blank"
                className="email_subscribe"
            >
                {/* <label for="email">Email</label> */}
                <input 
                    class="input"
                    id="newsletter_email"
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Your email address..." 
                    required
                />

                <button class="button" id="subscribe">Subscribe</button>
            </form>
        </div>
    ,
})