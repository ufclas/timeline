# Conversation in the Neighborhood
This plugin creates a timeline feature that is used by the Center for Humanities (Conversations in the Neighborhood).
- Example - https://test.clas.ufl.edu/clas-main/conversations-in-the-neighborhood-lets-talk-about-food/

## Plugins Needed
- Advanced Custom Fields
  - File admin/inc/acf.php creates fields that will show up whenever a post template is set to "Event Timeline"
    - Fields
      - Timeline Side
        - Which side the event will show up on (left or right)
      - Event Date
        - Date the event will take place
      - Event Type
        - Type of event (this can be a category)
      - Event Color
        - Color the header of the event will be in the timeline
        - Red #620000
        - Blue #3a50ab
        - Green #005e3d
      - Link for Event Registration
        - Zoom/Eventbrite link for the event

## How To Use
1. Create a post with the template file "Event Timeline"
2. Add content to the main wysiwyg
3. Fill out the new fields that show up under "Timeline"
4. Add a featured image (400x300 is ideal)
5. Click publish
6. Create a page and use the following shortcode
```
[ufclas-timeline]
```
Shortcode is created in public/shortcodes/shortcodes.php
