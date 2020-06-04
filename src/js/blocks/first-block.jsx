const RandomImage = ({
    category
}) => 
    <img 
        alt={category} 
        src={`http://lorempixel.com/400/200/${category}`}
    />

window.wp.blocks.registerBlockType("myplugin/random-image", {
    title: "Random Image",
    icon: "format-image",
    category: "common",
    attributes: {
        title: {
            type: "string",
            selector: "h1",
            source: "text"
        },
        category: {
            type: "string",
            attribute: "alt",
            selector: "img",
        },

    },

    edit: ({attributes, setAttributes}) => {

        let { URLInput } = window.wp.blockEditor
        let {title, category} = attributes

        const setCategory = e => setAttributes({ category: e.target.value })

        const setTitle = newValue => setAttributes({ title: newValue })

        return(
            <form onSubmit={setCategory}>
                {category}
                {title}
                {category && <RandomImage category={category}/>}
                <URLInput value={title} onChange={setTitle}/>
                <select value={category} onChange={setCategory}>
                    <option>-</option>
                    <option value="sports">Sports</option>               
                    <option value="animals">Animals</option>               
                    <option value="nature">Nature</option>
                </select>
            </form>
        )
    },

    save: ({attributes}) => 
        <>
            <RandomImage category={attributes.category} />
            <h1>{attributes.title}</h1>
        </>
})