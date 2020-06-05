const { registerBlockType } = window.wp.blocks
const { InnerBlocks } = window.wp.blockEditor

const icon = 
    <svg width="199" height="76" viewBox="0 0 199 76" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="59" height="76" rx="8" fill="#212121"/>
        <rect x="70" width="59" height="76" rx="8" fill="#212121"/>
        <rect x="140" width="59" height="76" rx="8" fill="#212121"/>
    </svg>

registerBlockType( 'lbh/service-teasers', {
    title: "Service teasers",
    icon: icon,
    category: "hackney",
    edit: () => 
        <InnerBlocks allowedBlocks={['lbh/service-teaser']} />
    ,
    save: () => {
        return (
            <div>
                <InnerBlocks.Content />
            </div>
        );
    },
} );