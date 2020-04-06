import smoothscroll from 'smoothscroll-polyfill';

(() => {
    // Getting the thumbnails
    const thumbnails = document.getElementsByClassName('js-thumbnail');

    // Early return if there's no thumbnails
    if (!thumbnails.length) return;
        
    // kick off the polyfill!
    smoothscroll.polyfill();

    const forEach = (arr, callback) => {
        let i = 0;
        const { length } = arr;
        while (i < length) {
            callback(arr[i], i);
            i += 1;
        }
    };


    const handleAnchors = (event, thumbnail) => {
        const hashtagIndex = thumbnail.href.indexOf('#');
        const isAnchor = hashtagIndex >= 0;
        if (!isAnchor) return;
        
        // Prevent click if it's an anchor
        event.preventDefault();
        
        // Get the section's name from the clicked anchor
        const sectionName = thumbnail.href.slice(hashtagIndex + 1);
        
        // Getting section from anchor's name
        const [section] = document.getElementsByClassName(sectionName);
        if (!section) return;

        const { top } = section.getBoundingClientRect();
        const scrollDistance = (window.scrollY || window.pageYOffset) + top;

        window.scroll({ top: scrollDistance, left: 0, behavior: 'smooth' });
    };

    const handleLinks = () => {
        forEach(thumbnails, thumbnail => {
            thumbnail.addEventListener('click', () => {
                handleAnchors(event, thumbnail);
            }, false)
        })
    };

    handleLinks();
})();