setwd("C:/Users/Hsin Yee/Documents/Dropbox")

library("tidyverse")

df <- readxl::read_excel("MOCK_DATA.xlsx")
p_map <- readxl::read_excel("MBTI Dictionary.xlsx")
View(df); View(p_map)

com_size <- 1000
grp_size <- 25
min_crit <- 5
num_grps <- com_size/grp_size

sub_df <- df[1:com_size, ]

# split into country buckets

bucket_list <- list()

for (i in 1:length(unique(sub_df$Country))) {
  bucket_list[[i]] <- subset( sub_df, Country == unique(sub_df$Country)[i] )
}

# put 1 person in each group
grp_df <- NULL
for (i in 1:num_grps){ grp_df <- rbind(grp_df, sub_df[i, ]) }
grp_df$`Group No.` <- 1:num_grps
# View(grp_df)

comp_df <- sub_df[-c(1:num_grps), ]; View(comp_df)

for (j in 1:num_grps) {
  
  k <- 1

  while ( dim(subset(grp_df, `Group No.` == j))[1] < min_crit ) {
    
    if ( all(subset(grp_df, `Group No.` == j)$Country != comp_df[k, ]$Country) ) {
        temp_df <- NULL
        temp_df <- comp_df[k, ]
        temp_df$`Group No.` <- j
        grp_df <- rbind(grp_df, temp_df) } 
    
    k <- k + 1

  }
  
  # remove taken people from comp_df
  comp_df <- anti_join(comp_df, grp_df)

}

View(grp_df)

people_left <- anti_join(comp_df, grp_df) 
totscore_list <- list()
num_tries <- 10000
optimal_df <- NULL

for (z in 1:num_tries) {
  
  # RANDOMISE PEOPLE_LEFT
  people_left <- people_left[sample(nrow(people_left)), ] # mute this for original people left
  people_left$`Group No.` <- c(1:num_grps) 
  interim_df <- rbind(grp_df, people_left)  
  interim_df <- interim_df[order(interim_df$`Group No.`), ] # %>% View()
  
  # compute score for each group (LOOP)
  
  score_list <- list()
  
  for (n in 1:num_grps) {
    # parse personality list
    interim_grp <- subset(interim_df, `Group No.` == n) 
    p_list <- interim_grp$Personality
    grp_score <- 0
  
    # score for grp_df (G1)
    for (i in 1:length(p_list)) {
      p_char <- as.character(p_map[which(p_map$Type == interim_grp$Personality[i]), 2])
      p_matches <- strsplit(p_char, ", ")[[1]]
      p_sub <- p_list[-c(i)]
      for (j in 1:length(p_sub)) {
        if (any(p_sub[j] == p_matches)) { grp_score <- grp_score + 1 }
      }
    }
    
    score_list[[n]] <- grp_score
    
  }
  
  tot_score <- do.call(sum, score_list)
  totscore_list[[z]] <- tot_score
  if (length(totscore_list) > 1 && totscore_list[[z]] > totscore_list[[z-1]]) { optimal_df <- interim_df }
}

# first rand set -- do.call(sum, score_list) [1] 5653
# max(unlist(totscore_list)) [1] 6040
# max(unlist(totscore_list)) [1] 6087

View(totscore_list); View(optimal_df)
max(unlist(totscore_list))

write.csv(optimal_df, file = "optimal_df_10000.csv")







