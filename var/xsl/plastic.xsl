<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns="http://www.w3.org/2000/svg">

    <xsl:output
        method="xml"
        indent="yes"
        standalone="no"
        doctype-public="-//W3C//DTD SVG 1.1//EN"
        doctype-system="http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"
        media-type="image/svg"/>

    <xsl:template match="/badge">
        <svg xmlns="http://www.w3.org/2000/svg" width="{@width}" height="18">
            <linearGradient id="smooth" x2="0" y2="100%">
                <stop offset="0" stop-color="#fff" stop-opacity=".7"/>
                <stop offset=".1" stop-color="#aaa" stop-opacity=".1"/>
                <stop offset=".9" stop-color="#000" stop-opacity=".3"/>
                <stop offset="1" stop-color="#000" stop-opacity=".5"/>
            </linearGradient>

            <mask id="round">
                <rect width="{@width}" height="18" rx="4" fill="#fff"/>
            </mask>

            <g mask="url(#round)">
                <rect width="{subject/@width}" height="18" fill="{subject/@color}"/>
                <rect x="{subject/@width}" width="{status/@width}" height="18" fill="{status/@color}"/>
                <rect width="{@width}" height="18" fill="url(#smooth)"/>
            </g>

            <g fill="#fff" text-anchor="middle" font-family="FreeSans,Verdana,Geneva,sans-serif" font-size="11">
                <text x="{subject/@position}" y="14" fill="#010101" fill-opacity=".3">
                    <xsl:value-of select="subject"/>
                </text>
                <text x="{subject/@position}" y="13">
                    <xsl:value-of select="subject"/>
                </text>
                <text x="{status/@position}" y="14" fill="#010101" fill-opacity=".3">
                    <xsl:value-of select="status"/>
                </text>
                <text x="{status/@position}" y="13">
                    <xsl:value-of select="status"/>
                </text>
            </g>
        </svg>
    </xsl:template>

</xsl:stylesheet>
