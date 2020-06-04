const { registerBlockType } = window.wp.blocks
const { InnerBlocks } = window.wp.blockEditor

registerBlockType( 'lbh/service-teasers', {
    title: "Service teasers",
    icon: "editor-table",
    category: "common",
    edit: () => <InnerBlocks allowedBlocks={['lbh/service-teaser']} />,
    save: () => {
        return (
            <div>
                <InnerBlocks.Content />
            </div>
        );
    },
} );