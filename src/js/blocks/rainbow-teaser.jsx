

import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
 
wp.blocks.registerBlockType( 'gutenberg-examples/example-06', {
    title: "Rainbow teaser",
    icon: "editor-table",
    category: "common",
 
    edit: ( { className } ) => {
        return (
            <div className={ className }>
                <InnerBlocks />
            </div>
        );
    },
 
    save: ( { className } ) => {
        return (
            <div className={ className }>
                <InnerBlocks.Content />
            </div>
        );
    },
} );