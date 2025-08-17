# Author Bio Setup Instructions

The AI Search Optimization theme includes a beautiful author bio box that appears at the bottom of every blog post. Here's how to set it up:

## 1. Set Up Your Author Profile

1. **Login to WordPress Admin**
2. **Go to Users > Your Profile**
3. **Fill in the following fields:**

### Basic Information
- **Display name publicly as**: Choose how you want your name to appear
- **Biographical Info**: Add your professional bio (optional - theme provides default)

### Author Information (Custom Fields)
- **LinkedIn URL**: Your full LinkedIn profile URL (e.g., https://linkedin.com/in/your-profile)
- **X (Twitter) URL**: Your full X/Twitter profile URL (e.g., https://x.com/your-handle)

### Profile Picture
- **Gravatar**: Upload a professional headshot at [gravatar.com](https://gravatar.com) using the same email as your WordPress account
- **Recommended**: 400x400px or larger, professional headshot with good lighting

## 2. Sample Author Bio Text

If you want to customize the author description, use this template:

```
[Your Name] is an independent SEO consultant based in [Your City], [Your Country]. Specializing in technical SEO, Google Discover optimization, international SEO, eCommerce SEO, comprehensive SEO audits, and one-time consultations, [he/she] works with eCommerce brands to enhance visibility in Google's search results across evolving landscapes, including different countries and platforms.
```

## 3. Features of the Author Bio

- ✅ **Gradient Background**: Beautiful purple gradient background
- ✅ **Professional Layout**: Photo, name, title, and social links
- ✅ **Expertise Tags**: Displays 6 key expertise areas
- ✅ **Social Links**: LinkedIn and X/Twitter with working links
- ✅ **Responsive Design**: Looks great on all devices
- ✅ **Always Visible**: Shows on every blog post automatically

## 4. Customizing Expertise Areas

To modify the expertise tags, edit the `functions.php` file in the theme:

```php
echo '<span class="expertise-item">Your Custom Expertise</span>';
```

Current expertise areas:
- Technical SEO
- Google Discover Optimization
- International SEO
- eCommerce SEO
- SEO Audits
- AI Search Optimization

## 5. Styling Customization

The author bio styling can be customized in `style.css` under the `/* Author Bio */` section.

Key CSS classes:
- `.author-bio` - Main container
- `.author-avatar` - Profile image
- `.author-details` - Text content area
- `.expertise-item` - Individual expertise tags

## 6. Testing

After setup:
1. **Create a test blog post**
2. **View the post on the frontend**
3. **Scroll to the bottom** to see your author bio
4. **Test social links** to ensure they work correctly

The author bio will automatically appear on all single blog posts with your information! 