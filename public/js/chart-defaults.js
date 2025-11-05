/**
 * UBDomains Chart Defaults
 * Global Chart.js configuration for consistent styling across all dashboards
 *
 * Usage:
 * new Chart(ctx, {
 *   type: "bar",
 *   data: {...},
 *   options: {
 *     ...UBDomainsChartDefaults.getDefaultOptions(),
 *     scales: {
 *       y: UBDomainsChartDefaults.getYAxisConfig(),
 *       x: UBDomainsChartDefaults.getXAxisConfig()
 *     }
 *   }
 * });
 */

const UBDomainsChartDefaults = {
  // Font configuration
  font: {
    family: 'Inter',
    size: 11,
    style: 'normal',
    lineHeight: 2
  },

  // Color palette
  colors: {
    primary: '#3A416F',      // UBDomains dark blue (brand color)
    secondary: '#43A047',    // Green (accent/success color)
    tickColor: '#9ca2b7',
    gridColor: '#e5e5e5'
  },

  /**
   * Get default chart options
   * @returns {Object} Default chart configuration
   */
  getDefaultOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      interaction: {
        intersect: false,
        mode: 'index'
      }
    };
  },

  /**
   * Get Y-axis configuration
   * @returns {Object} Y-axis configuration with grid and ticks
   */
  getYAxisConfig() {
    return {
      grid: {
        drawBorder: false,
        display: true,
        drawOnChartArea: true,
        drawTicks: false,
        borderDash: [5, 5],
        color: this.colors.gridColor
      },
      ticks: {
        display: true,
        padding: 10,
        color: this.colors.tickColor,
        font: {
          size: this.font.size,
          family: this.font.family,
          style: this.font.style,
          lineHeight: this.font.lineHeight
        }
      }
    };
  },

  /**
   * Get X-axis configuration
   * @returns {Object} X-axis configuration with grid and ticks
   */
  getXAxisConfig() {
    return {
      grid: {
        drawBorder: false,
        display: false,
        drawOnChartArea: false,
        drawTicks: false
      },
      ticks: {
        display: true,
        color: this.colors.tickColor,
        padding: 10,
        font: {
          size: this.font.size,
          family: this.font.family,
          style: this.font.style,
          lineHeight: this.font.lineHeight
        }
      }
    };
  },

  /**
   * Create a linear gradient for chart backgrounds
   * @param {CanvasRenderingContext2D} ctx - Canvas context
   * @param {string} colorKey - Color key from palette (e.g., 'primary', 'secondary')
   * @param {number} maxOpacity - Maximum opacity for gradient (0-1)
   * @returns {CanvasGradient} Linear gradient object
   */
  createGradient(ctx, colorKey = 'primary', maxOpacity = 0.2) {
    const gradient = ctx.createLinearGradient(0, 230, 0, 50);
    const color = this.colors[colorKey] || this.colors.primary;

    // Convert hex to RGB
    const r = parseInt(color.slice(1, 3), 16);
    const g = parseInt(color.slice(3, 5), 16);
    const b = parseInt(color.slice(5, 7), 16);

    gradient.addColorStop(1, `rgba(${r}, ${g}, ${b}, ${maxOpacity})`);
    gradient.addColorStop(0.2, `rgba(${r}, ${g}, ${b}, 0.0)`);
    gradient.addColorStop(0, `rgba(${r}, ${g}, ${b}, 0)`);

    return gradient;
  },

  /**
   * Get default configuration for line chart datasets
   * @param {string} colorKey - Color key from palette (default: 'primary')
   * @returns {Object} Line dataset configuration
   */
  getLineDatasetDefaults(colorKey = 'primary') {
    const color = this.colors[colorKey] || this.colors.primary;
    return {
      tension: 0.4,
      borderWidth: 3,
      pointRadius: 2,
      pointBackgroundColor: color,
      pointBorderColor: 'transparent',
      borderColor: color,
      fill: true,
      maxBarThickness: 6
    };
  },

  /**
   * Get default configuration for bar chart datasets
   * @param {string} colorKey - Color key from palette (default: 'primary')
   * @returns {Object} Bar dataset configuration
   */
  getBarDatasetDefaults(colorKey = 'primary') {
    const color = this.colors[colorKey] || this.colors.primary;
    return {
      tension: 0.4,
      borderWidth: 0,
      borderRadius: 4,
      borderSkipped: false,
      backgroundColor: color,
      barThickness: 'flex'
    };
  }
};
