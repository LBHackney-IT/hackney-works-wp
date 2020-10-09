const { registerBlockType } = window.wp.blocks
const { InnerBlocks, RichText } = window.wp.blockEditor

const icon = 
    <svg width="188" height="71" viewBox="0 0 188 71" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect y="51" width="49" height="20" rx="8" fill="#212121"/>
        <rect x="139" y="51" width="49" height="20" rx="8" fill="#212121"/>
        <rect x="69" y="51" width="49" height="20" rx="8" fill="#212121"/>
        <circle cx="24.5" cy="15.5" r="15.5" fill="#212121"/>
        <circle cx="163.5" cy="15.5" r="15.5" fill="#212121"/>
        <circle cx="93.5" cy="15.5" r="15.5" fill="#212121"/>
    </svg>

registerBlockType( 'lbh/selling-points', {
    title: "Selling points",
    icon: icon,
    category: "hackney",

    edit: ({ className }) => 
        <div className={className}>
            <InnerBlocks allowedBlocks={['lbh/selling-point']} />
            <a href="https://fontawesome.com/icons?d=gallery&m=free" target="blank">Icon class reference</a>
        </div>
    ,

    save: ({ className }) => 
        <div className="selling-points">
            <div class="container">
                <InnerBlocks.Content />
            </div>
        </div>
    ,
})