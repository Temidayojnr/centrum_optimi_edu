# System Logs - Responsive Design Guide

## Quick Overview

The System Logs page is now fully responsive with optimized layouts for desktop, tablet, and mobile devices.

## Layout Breakpoints

### 📱 Mobile (< 640px)

**Container:**
```
Padding: 0.5rem (px-2)
Max-width: Full viewport
```

**Controls Grid:**
```
Columns: 1 (stacked vertically)
Gap: 0.75rem
```

**Table:**
```
Timestamp column: 100px
Level column: 90px
Font size: 0.75rem (text-xs)
```

**Buttons:**
```
Icon only (text hidden)
Padding: 0.75rem × 0.75rem
Text: Extra small (text-xs)
```

**Example:**
```
┌─────────────────────────┐
│ [Log File Dropdown]     │
│ [Level Filter]          │
│ [Search Box]            │
│ [Filter] [Reset]        │
├─────────────────────────┤
│ Time    │ Lvl │ Message │
│ 11:57   │ ERR │ Syntax..│
│         │     │ [↓]     │
└─────────────────────────┘
```

---

### 📱 Tablet (640px - 768px)

**Container:**
```
Padding: 1rem (px-4)
Max-width: Full viewport
```

**Controls Grid:**
```
Columns: 2 (two items per row)
Gap: 1rem
```

**Table:**
```
Timestamp column: 144px
Level column: 112px
Font size: 0.875rem (text-sm)
```

**Buttons:**
```
Icon + partial text
Padding: 1rem × 0.75rem
Text: Small (text-sm)
```

**Example:**
```
┌───────────────────────────────────┐
│ [Log File]        [Level Filter]  │
│ [Search Box]      [Actions]       │
├───────────────────────────────────┤
│ Timestamp  │ Level  │ Message     │
│ 11:57:07   │ ERROR  │ Syntax err..│
│            │        │ [Expand ↓]  │
└───────────────────────────────────┘
```

---

### 💻 Desktop (768px - 1024px)

**Container:**
```
Padding: 1.5rem (px-6)
Max-width: Full viewport
```

**Controls Grid:**
```
Columns: 4 (all items in one row)
Gap: 1rem
```

**Table:**
```
Timestamp column: 192px (w-48)
Level column: 128px (w-32)
Font size: 0.875rem - 1rem
```

**Buttons:**
```
Icon + full text
Padding: 1rem × 1rem
Text: Standard (text-sm/base)
```

**Example:**
```
┌─────────────────────────────────────────────────────────────┐
│ [Log File Selector] [Level Filter] [Search] [Filter] [Reset]│
├─────────────────────────────────────────────────────────────┤
│ Timestamp        │ Level      │ Message                     │
│ 2025-11-12 11:57 │ ERROR     │ PHP Parse error: Syntax...  │
│                  │           │ [Expand Details ↓]          │
└─────────────────────────────────────────────────────────────┘
```

---

### 🖥️ Large Desktop (> 1024px)

**Container:**
```
Padding: 1.5rem (px-6)
Max-width: Full viewport
```

**Controls Grid:**
```
Columns: 4 (spacious layout)
Gap: 1rem
```

**Table:**
```
Timestamp column: 192px (w-48)
Level column: 128px (w-32)
Font size: 1rem (text-base)
```

**Buttons:**
```
Icon + full text + hover effects
Padding: 1rem × 1rem
Text: Standard/Large
```

---

## Component Responsive Behavior

### Header Section

| Screen Size | Heading Size | Padding |
|-------------|--------------|---------|
| Mobile      | 1.5rem (text-2xl) | mb-4 |
| Tablet      | 1.875rem (text-3xl) | mb-6 |
| Desktop     | 1.875rem (text-3xl) | mb-6 |

### Controls Section

**Mobile Layout:**
```
┌─────────────────┐
│ Log File        │
├─────────────────┤
│ Level Filter    │
├─────────────────┤
│ Search          │
├─────────────────┤
│ Actions         │
└─────────────────┘
```

**Tablet Layout:**
```
┌─────────┬─────────┐
│ Log File│ Level   │
├─────────┼─────────┤
│ Search  │ Actions │
└─────────┴─────────┘
```

**Desktop Layout:**
```
┌────────┬────────┬────────┬────────┐
│Log File│ Level  │ Search │Actions │
└────────┴────────┴────────┴────────┘
```

### Table Columns

**Mobile:**
- Time (100px) - Abbreviated
- Lvl (90px) - Short badges
- Message (flexible) - Truncated

**Tablet:**
- Timestamp (144px) - Full time
- Level (112px) - Full badges
- Message (flexible) - More text

**Desktop:**
- Timestamp (192px) - Full datetime
- Level (128px) - Full badges with icons
- Message (flexible) - Full text preview

### Log Details Panel

**All Sizes:**
```
Max Height: 320px (max-h-80)
Overflow: Vertical scroll
Background: White
Border: Gray-300
Shadow: Small
Padding: 0.75rem
```

**Mobile Specific:**
```css
margin-left: -0.5rem;
margin-right: -0.5rem;
border-radius: 0.5rem;
```

**Desktop Specific:**
```css
margin: 1rem 0;
border-radius: 0.5rem;
```

### Action Buttons

**Mobile:**
```html
<button class="px-3 py-2 text-xs">
  <i class="fas fa-download"></i>
  <!-- Text hidden -->
</button>
```

**Tablet:**
```html
<button class="px-3 py-2 text-sm">
  <i class="fas fa-download mr-1"></i>
  Download
</button>
```

**Desktop:**
```html
<button class="px-4 py-2 text-sm">
  <i class="fas fa-download mr-1"></i>
  Download Log File
</button>
```

## Interaction Patterns

### Expandable Rows

**Desktop:**
1. Click chevron icon to expand
2. Details slide down with animation
3. Smooth scroll to keep row visible
4. Click close button or chevron to collapse

**Mobile:**
1. Tap chevron icon to expand
2. Details appear below message
3. Scrollable if content is long
4. Tap close button to collapse

### Touch Targets

| Element | Mobile Size | Desktop Size |
|---------|-------------|--------------|
| Chevron button | 44px × 44px | 36px × 36px |
| Close button | 44px × 44px | 32px × 32px |
| Action buttons | 44px min height | 40px height |
| Filter dropdowns | 44px height | 40px height |

## Accessibility

### Keyboard Navigation
- ✅ Tab through all interactive elements
- ✅ Enter/Space to activate buttons
- ✅ Escape to close expanded details
- ✅ Arrow keys in dropdowns

### Screen Readers
- ✅ ARIA labels on icon-only buttons
- ✅ Role attributes on interactive elements
- ✅ Alt text for status indicators
- ✅ Semantic HTML structure

### Color Contrast
- ✅ WCAG AA compliant text colors
- ✅ Sufficient contrast for badges
- ✅ Focus indicators visible
- ✅ Error states clearly marked

## Performance Tips

### Mobile Optimization
1. **Reduce Initial Load**: Only show 25 entries on mobile
2. **Lazy Load**: Load details content only when expanded
3. **Touch Optimization**: Use CSS touch-action for better scrolling
4. **Image Optimization**: No heavy images in log viewer

### Desktop Optimization
1. **Pagination**: Show 50 entries per page
2. **Virtual Scrolling**: For very large log files (future)
3. **Debounced Search**: 300ms delay on search input
4. **Cached Results**: Cache parsed logs in session

## Testing Checklist

### Visual Testing
- [ ] Test on iPhone (375px)
- [ ] Test on iPad (768px)
- [ ] Test on desktop (1920px)
- [ ] Test on ultrawide (2560px)
- [ ] Test landscape orientation
- [ ] Test with browser zoom (50% - 200%)

### Functional Testing
- [ ] Expand/collapse works on all sizes
- [ ] Scrolling smooth in details panel
- [ ] No horizontal overflow
- [ ] Buttons are tappable/clickable
- [ ] Forms submit correctly
- [ ] Filters work on mobile
- [ ] Search works on mobile

### Browser Testing
- [ ] Chrome mobile
- [ ] Safari mobile
- [ ] Firefox mobile
- [ ] Chrome desktop
- [ ] Safari desktop
- [ ] Firefox desktop
- [ ] Edge desktop

## Common Issues & Solutions

### Issue: Horizontal Scrolling on Mobile
**Solution:**
```css
body, html {
    overflow-x: hidden;
    max-width: 100vw;
}
```

### Issue: Details Panel Too Wide
**Solution:**
```css
div[id^="details-"] {
    max-width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
}
```

### Issue: Buttons Too Small on Mobile
**Solution:**
```css
@media (max-width: 640px) {
    button {
        min-height: 44px;
        min-width: 44px;
    }
}
```

### Issue: Table Overflowing Container
**Solution:**
```css
table {
    table-layout: fixed;
    width: 100%;
}
```

## Resources

- [Tailwind Responsive Design](https://tailwindcss.com/docs/responsive-design)
- [MDN Mobile First](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Responsive/Mobile_first)
- [WCAG Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

---

**Last Updated**: November 12, 2025  
**Version**: 2.0
