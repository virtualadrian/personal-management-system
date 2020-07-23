export default class Accordion {

    private selectors = {
        ids: {
            accordionId: '#accordion'
        }
    };

    /**
     * Will apply accordion on given elements
     */
    public applyAccordion(): void
    {
        //@ts-ignore
        $(this.selectors.ids.accordionId).accordion({
            header      : "h3",
            collapsible : true,
            active      : false,
            autoHeight  : false
        });
    };

    /**
     * In some cases accordion won't work if display is set to flex
     *  accordion needs to be initialized first and then css must be applied so it will work fine
     */
    public fixAccordionsForDisplayFlex(): void
    {
        let accordionSectionSelectorForMyTravels = '.MyTravelIdeas .ui-accordion-content';
        let cssFlex = {
            "display"   : "flex",
            "flex-wrap" : "wrap",
            "padding"   : "5px"
        };
        let allSelectorsToFix = [
            accordionSectionSelectorForMyTravels
        ];

        $.each(allSelectorsToFix, function (index, selector) {
            if ($(selector).length > 0) {
                $(selector)
                    .css(cssFlex)
                    //@ts-ignore
                    .collapse('hide')
                    .hide();
            }
        });
    };
}