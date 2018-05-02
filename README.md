# Welcome to KickFounder
## Description
[Kickfounder](https://github.com/googlr/KickFounder), a new database-backed website for crowdfunding aim to help people raise money for various activities. In this platform, users can either create projects or pledge money toward any projects they like. When a project is funded and completed, users who pledge the project can rate the project.

In addition, the platform provide attractive social features, users can leave their comment and discuss projects, like a project, and follow other people. Moverover, based on user activity logs and project tags, etc., our recommendation algorithm will recommend relevant projects that users might be interested in.

## Main Features
  - Designed the relational schema and implemented a web-based user interface with PHP and mySQL.
  - Integrated the service with a recommendation system based on tags and user activity logs.
  - Leveraged multiple defensive techniques to mitigate SQL injection and cross-site scripting(XSS) threats, including but not limited to
    1. PHP prepared statements
    2. HTML input attribute(type, pattern, maxlength)
    3. Manual test of input

## Database Design Schema
<img src="https://github.com/googlr/KickFounder/blob/master/figures/DatabaseDesignSchema.jpg" alt="Database Design Schema" align="middle" width="80%"/>
<!-- style="margin:0px auto;display:block" -->
<!-- ![Database Design Schema](https://github.com/googlr/KickFounder/blob/master/figures/DatabaseDesignSchema.jpg) -->

## Data Flow Diagram
<img src="https://github.com/googlr/KickFounder/blob/master/figures/DataFlowDiagramOfKickfounder.jpg" alt="Data Flow Diagram of Kickfounder" align="middle" width="80%"/>
<!-- ![Data Flow Diagram of Kickfounder](https://github.com/googlr/KickFounder/blob/master/figures/DataFlowDiagramOfKickfounder.jpg) -->

## A few words from the co-founders and future work
> In this project, we have designed the schema from scratch and implemented a functional website for crowdfunding. Instead of making a toy model, we think from the perspective of various real-world situations and aim to make the website practical and robust.

> As previously shown, we have implemented the fundamental features for a crowdfunding website, where users are free to create, pledge, rate and comment on a project. If we could bring real payment methods into our system, our system will run like any other similar service.

> Frankly speaking, as the co-founder of KickFounder, we still have a long way to go if we’d like to make it available to the public, especially when compared with existing competitors like `KickStarter` or `Indiegogo`. Though we have taken proactive measures to block out potential hackers, for instance, prevention on `SQL injection` and `cross-site scripting`, store the hash value of passwords instead of plain text, etc, the security of our system is far from perfect. The future work include but not limited to end-to-end encryption, anti-brute-force-password-guessing policy. By the way, A user experience designer position is opening to the public and anyone who has previous experience is welcomed to apply. Join now and make a difference with us in **KickFouder**.
